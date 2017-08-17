<?php

function load_posts() {
  $result = array();

  $context = Timber::get_context();

  $offset = isset($_REQUEST['offset']) ? intval($_REQUEST['offset']) : 0;
  $posts_per_page = isset($_REQUEST['postsPerPage']) ? intval($_REQUEST['postsPerPage']) : 9;
  $paged = isset($_REQUEST['paged']) ? intval($_REQUEST['paged']) : 1;

  $taxonomy = isset($_REQUEST['taxonomy']) ? $_REQUEST['taxonomy'] : "";
  $term_id = isset($_REQUEST['termId']) ? intval($_REQUEST['termId']) : "";
  $author = isset($_REQUEST['author']) ? intval($_REQUEST['author']) : "";
  $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : "";

  $result['request'] = $_REQUEST;

  $args = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged
  );

  if ($paged > 1) {
    $args['offset'] = $offset + ( ($paged - 1) * $posts_per_page );
  } else {
    $args['offset'] = $offset;
  }

  if (!empty($taxonomy) && !empty($term_id)) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => $taxonomy,
        'field' => 'term_id',
        'terms' => array($term_id)
      )
    );
  }

  if (!empty($author)) {
    $args['author'] = $author;
  }

  if (!empty($search)) {
    $args['s'] = $search;
  }

  $posts = Timber::get_posts($args);

  $result['args'] = $args;
  $result['posts'] = $posts;

  if (count($posts) > 0) {
    $result['have_posts'] = true;

    if (count($posts) >= $posts_per_page) {
      $result['have_posts_next'] = true;
    } else {
      $result['have_posts_next'] = false;
    }

    $count = 0;

    ob_start();

    foreach ($posts as $post) {
      $context['post'] = $post;
      $post->class .= " col-md-6 col-lg-4";

      $count++;

      if ($count <= $posts_per_page) {
        Timber::render('tease-' . $post->post_type . '.twig', $context);
      }
    }

    $result['html'] = ob_get_clean();
  } else {
    $result['have_posts'] = false;
  }

  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $result = json_encode($result);
    echo $result;
  } else {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
  }

  die();
}

add_action( 'wp_ajax_load_posts', 'load_posts' );
add_action( 'wp_ajax_nopriv_load_posts', 'load_posts' );

function submit_contact_form() {
  check_ajax_referer('submit_contact_form', '_wpnonce');

  $data = array();

  foreach ($_POST as $key => $value) {
    $data[$key] = $value;
  }

  $data['newsletter'] = isset($data['newsletter']) ? true : false;

  $newsletter = $data['newsletter'] ? __('Yes', 'blendid') : __('No', 'blendid');

  $data['message'] = nl2br($data['message']);

  $to = get_field('email', 'option') ? get_field('email', 'option') : get_bloginfo('admin_email');

  $message = "
    <html>
      <head>
        <title>{$data['subject']}</title>
      </head>
      <body>
        <p>Förnamn: {$data['firstname']}</p>
        <p>Efternamn: {$data['lastname']}</p>
        <p>E-post: {$data['email']}</p>
        <p>Telefon: {$data['phone']}</p>
        <p>Nyhetsbrev: {$newsletter}</p>
        <p>Meddelande: <br /><br /> {$data['message']}</p>
        <p>Url: {$data['url']}</p>
      </body>
    </html>
  ";

  // To send HTML mail, the Content-type header must be set
  $headers[] = "MIME-Version: 1.0";
  $headers[] = "Content-type: text/html; charset=UTF-8";
  $headers[] = "X-Mailer: PHP/" . phpversion();

  // Additional headers
  $headers[] = "From: {$data['name']} <{$data['email']}>";

  $mail = mail($to, $data['subject'], $message, implode("\r\n", $headers));

  if ($mail) {
    echo json_encode( array( 'status' => true, 'message' => __('Your message has been sent', 'blendid'), 'data' => $data ) );
  } else {
    echo json_encode( array( 'status' => false, 'message' => __('Something went wrong. Please try again', 'blendid'), 'data' => $data ) );
  }

  die();
}

add_action( 'wp_ajax_submit_contact_form', 'submit_contact_form' );
add_action( 'wp_ajax_nopriv_submit_contact_form', 'submit_contact_form' );