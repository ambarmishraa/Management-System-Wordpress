<?php
/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'twentytwentyfour_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */



	function twentytwentyfour_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'twentytwentyfour' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'twentytwentyfour' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfour' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'twentytwentyfour' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'twentytwentyfour' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'twentytwentyfour_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'twentytwentyfour-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'twentytwentyfour_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfour_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'twentytwentyfour' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfour' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_pattern_categories' );

/**
 * Enqueue JavaScript for AJAX
 */
function enqueue_my_scripts() {
    wp_enqueue_script('my-ajax-script', get_template_directory_uri() . '/Management-System/Coordinator/ajax-script.js', array('jquery'), null, true);
    
    wp_localize_script('my-ajax-script', 'my_ajax_obj', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');

/**
 * Handle AJAX requests
 */
function handle_ajax_requests() {
    global $wpdb;
    $coordinator_table = $wpdb->prefix . 'coordinator'; 

    // Creating Coordinator
    if (isset($_POST['action_type']) && $_POST['action_type'] === 'create') {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $wpdb->insert($coordinator_table,
            array(
                'name' => $name,
                'email' => $email
            ),
            array('%s', '%s')
        );
        echo 'Coordinator added successfully!';
    }

    // Updating Coordinator
    elseif (isset($_POST['action_type']) && $_POST['action_type'] === 'update') {
        $id = intval($_POST['id']);
        $name = $_POST['name'];
        $email = $_POST['email'];

        $wpdb->update($coordinator_table, 
            array(
                'name' => $name,
                'email' => $email
            ),
            array('id' => $id),
            array('%s', '%s'),
            array('%d') 
        );
        echo 'Coordinator updated successfully!';
    }

    // Deleting Coordinator
    elseif (isset($_POST['action_type']) && $_POST['action_type'] === 'delete') {
        $id = intval($_POST['id']);

        $wpdb->delete($coordinator_table,
            array('id' => $id), 
            array('%d')
        );
        echo 'Coordinator deleted successfully!';
    } else {
        echo 'Invalid action!';
    }

    wp_die(); 
}

add_action('wp_ajax_handle_request', 'handle_ajax_requests');
add_action('wp_ajax_nopriv_handle_request', 'handle_ajax_requests');

/**
 * Styling the css
 */

function style() {
   
    wp_enqueue_style('home-style', get_template_directory_uri() . '/Management-System/index.css' );

    wp_enqueue_style('coordinator-style', get_template_directory_uri() . '/Management-System/Coordinator/coordinator.css' );

    // wp_enqueue_style('marksEdit-style', get_template_directory_uri() . '/Management-System/Marks/marks_edit.css' );

    wp_enqueue_style('course-style', get_template_directory_uri() . '/Management-System/Course/course.css' );

    wp_enqueue_style('marks-style', get_template_directory_uri() . '/Management-System/Marks/marks.css' );

    wp_enqueue_style('student-style', get_template_directory_uri() . '/Management-System/Student/student.css' );

    wp_enqueue_style('subject-style', get_template_directory_uri() . '/Management-System/Subject/subject.css' );

    wp_enqueue_style('subcourse-style', get_template_directory_uri() . '/Management-System/Subject-Course-Relation/sub-course.css' );

    wp_enqueue_style('navbar-style', get_template_directory_uri() . '/Management-System/Shared/navbar/navbar.css' );

}
add_action('wp_enqueue_scripts', 'style'); 

/**
 * Enqueue JavaScript for AJAX
 */
function enqueue_course_script() {
    wp_enqueue_script('course-script', get_template_directory_uri() . '/Management-System/Course/course-script.js', array('jquery'), null, true);
    
    wp_localize_script('course-script', 'ajax_object', array(
        'course_ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_course_script');

/**
 * Handle AJAX requests
 */
function submit_course_form() {
    global $wpdb;
    $table_course = $wpdb->prefix . 'course'; 
    $table_coordinator = $wpdb->prefix . 'coordinator';

    // Create or Update Course
    if (isset($_POST['action_type'])) {
        $action_type = sanitize_text_field($_POST['action_type']);

        if ($action_type === 'create_course') {
            $course_name = sanitize_text_field($_POST['course_name']);
            $course_code = sanitize_text_field($_POST['course_code']);
            $coordinator_id = intval($_POST['coordinator_id']); 

            $coordinator_exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_coordinator WHERE id = %d", $coordinator_id));

            if ($coordinator_exists) {
                $inserted = $wpdb->insert(
                    $table_course,
                    array(
                        'course_name' => $course_name,
                        'course_code' => $course_code,
                        'coordinator_id' => $coordinator_id
                    ),
                    array('%s', '%s', '%d')
                );

                if ($inserted !== false) {
                    wp_send_json_success('Course added successfully!');
                } else {
                    wp_send_json_error('Failed to add course.');
                }
            } else {
                wp_send_json_error('Coordinator does not exist.');
            }

        } elseif ($action_type === 'update_course') {
            $id = intval($_POST['id']);
            $course_name = sanitize_text_field($_POST['course_name']);
            $course_code = sanitize_text_field($_POST['course_code']); 
            $coordinator_id = intval($_POST['coordinator_id']); 

            $updated = $wpdb->update(
                $table_course,
                array(
                    'course_name' => $course_name,
                    'course_code' => $course_code,
                    'coordinator_id' => $coordinator_id
                ),
                array('id' => $id),
                array('%s', '%s', '%d'),
                array('%d')
            );

            if ($updated !== false) {
                wp_send_json_success('Course updated successfully!');
            } else {
                wp_send_json_error('Failed to update course.');
            }

        } elseif ($action_type === 'delete_course') {
            $id = intval($_POST['id']);

            $deleted = $wpdb->delete(
                $table_course,
                array('id' => $id),
                array('%d')
            );

            if ($deleted !== false) {
                wp_send_json_success('Course deleted successfully!');
            } else {
                wp_send_json_error('Failed to delete course.');
            }
        } else {
            wp_send_json_error('Invalid action type.');
        }
    } else {
        wp_send_json_error('No action type specified.');
    }

    wp_die();  
}

add_action('wp_ajax_submit_course_form', 'submit_course_form');
add_action('wp_ajax_nopriv_submit_course_form', 'submit_course_form'); 



//Subject Starts Here

/**
 * Enqueue JavaScript for AJAX
 */
function enqueue_subject_script() {
    wp_enqueue_script('subject-script', get_template_directory_uri() . '/Management-System/Subject/subject-script.js', array('jquery'), null, true);
    
    wp_localize_script('subject-script', 'ajax_subject_object', array(
        'subject_ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_subject_script');

/**
 * Handle AJAX requests
 */
function submit_subject_form() {
    global $wpdb;
    $table_subject = $wpdb->prefix . 'subject'; 

    // Create or Update Course
    if (isset($_POST['action_type'])) {
        $action_type = sanitize_text_field($_POST['action_type']);

        if ($action_type === 'create_subject') {
            $subject_name = sanitize_text_field($_POST['subject_name']);
            $subject_code = sanitize_text_field($_POST['subject_code']); 

            $inserted = $wpdb->insert(
                $table_subject,
                array(
                    'subject_name' => $subject_name, 
                    'subject_code' => $subject_code, 
                ),
                array('%s', '%s')
            );

            if ($inserted !== false) {
                wp_send_json_success('Subject created successfully!');
            } else {
                wp_send_json_error('Failed to create subject.');
            }

        } elseif ($action_type === 'update_subject') {
            $id = intval($_POST['id']);
            $subject_name = sanitize_text_field($_POST['subject_name']); 
            $subject_code = sanitize_text_field($_POST['subject_code']);  

            $updated = $wpdb->update(
                $table_subject,
                array(
                    'subject_name' => $subject_name,
                    'subject_code' => $subject_code
                ),
                array('id' => $id),
                array('%s', '%s'),
                array('%d')
            );

            if ($updated !== false) {
                wp_send_json_success('Subject updated successfully!');
            } else {
                wp_send_json_error('Failed to update subject.');
            }

        } elseif ($action_type === 'delete_subject') {
            $id = intval($_POST['id']);

            $deleted = $wpdb->delete(
                $table_subject,
                array('id' => $id),
                array('%d')
            );

            if ($deleted !== false) {
                wp_send_json_success('Subject deleted successfully!');
            } else {
                wp_send_json_error('Failed to delete subject.');
            }
        } else {
            wp_send_json_error('Invalid action type.');
        }
    } 

    wp_die(); 
}

add_action('wp_ajax_submit_subject_form', 'submit_subject_form');
add_action('wp_ajax_nopriv_submit_subject_form', 'submit_subject_form'); 


// Subject Course Relation Starts Here
/**
 * Enqueue JavaScript for AJAX
 */
function enqueue_subcourse_script() {
    wp_enqueue_script('subcourse-script', get_template_directory_uri() . '/Management-System/Subject-Course-Relation/subcourse.js', array('jquery'), null, true);
    
    wp_localize_script('subcourse-script', 'my_ajax_subcourse', array(
        'ajaxurl_subcourse' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_subcourse_script');

/**
 * Handle AJAX requests
 */
function submit_subcourse_form() {
    global $wpdb;
    $table_subcourse = $wpdb->prefix . 'subcourse'; 

  
    if (isset($_POST['action_type']) && $_POST['action_type'] === 'create_subcourse') {

        $course_id = intval($_POST['course_id']);
        $subject_ids = isset($_POST['subject_ids']) ? array_map('intval', explode(',', $_POST['subject_ids'])) : [];

        if ($course_id && !empty($subject_ids)) {
            // Insert each subject
            foreach ($subject_ids as $subject_id) {
                $wpdb->insert(
                    $table_subcourse,
                    array(
                        'course_id' => $course_id,
                        'subject_id' => $subject_id
                    ),
                    array('%d', '%d')
                );
            }

          
            wp_send_json_success('Subject-Course relation added successfully!');
        } else {
            wp_send_json_error('Invalid input.');
        }
    }

	  // Deleting Course
	  elseif (isset($_POST['action_type']) && $_POST['action_type'] === 'delete_subcourse') {
        $id = intval($_POST['id']);

        $wpdb->delete($table_subcourse,
            array('id' => $id), 
            array('%d')
        );
        echo 'Relation deleted successfully!';
    } else {
        echo 'Invalid action!';
    }

    wp_die(); 
}

add_action('wp_ajax_submit_subcourse_form', 'submit_subcourse_form');
add_action('wp_ajax_nopriv_submit_subcourse_form', 'submit_subcourse_form');


//Student Start Here

/**
 * Enqueue JavaScript for AJAX
 */
function enqueue_student_script() {
    wp_enqueue_script('student-script', get_template_directory_uri() . '/Management-System/Student/student-script.js', array('jquery'), null, true);
    
    wp_localize_script('student-script', 'ajax_student_object', array(
        'ajaxurl_student' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_student_script');

/**
 * Handle AJAX requests
 */
function submit_student_form() {
    global $wpdb;
    $table_student = $wpdb->prefix . 'student'; 
    $table_course = $wpdb->prefix . 'course';

    // Creating Student
    if (isset($_POST['action_type']) && $_POST['action_type'] === 'create_student') {
        $student_name = sanitize_text_field($_POST['student_name']);
        $student_email = sanitize_email($_POST['student_email']);
        $course_id = intval($_POST['course_id']); 

        $course_exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_course WHERE id = %d", $course_id));

        if ($course_exists) {
            $inserted = $wpdb->insert(
                $table_student,
                array(
                    'student_name' => $student_name,
                    'student_email' => $student_email,
                    'course_id' => $course_id
                ),
                array('%s', '%s', '%d')
            );

            if ($inserted) {
                echo 'Student added successfully!';
            } else {
                echo 'Error adding student!';
            }
        } else {
            echo 'Invalid course ID!';
        }
    }

    // Updating Student
    elseif (isset($_POST['action_type']) && $_POST['action_type'] === 'update_student') {
        if (isset($_POST['data'])) {
            parse_str($_POST['data'], $parsed_data);

            $id = intval($parsed_data['id']);
            $student_name = sanitize_text_field($parsed_data['student_name']);
            $course_id = intval($parsed_data['course_id']);

            $current_data = $wpdb->get_row($wpdb->prepare(
                "SELECT student_name, course_id FROM $table_student WHERE id = %d", $id
            ));

            if ($current_data && ($current_data->student_name === $student_name && $current_data->course_id == $course_id)) {
                wp_send_json_error('No changes made to the student record, as the data is identical.');
            } else {
                $updated = $wpdb->update(
                    $table_student,
                    array('student_name' => $student_name, 'course_id' => $course_id),
                    array('id' => $id),
                    array('%s', '%d'),
                    array('%d')
                );

                if ($updated === false) {
                    wp_send_json_error('Error updating record: ' . $wpdb->last_error);
                } elseif ($updated === 0) {
                    wp_send_json_error('No changes made to the student record.');
                } else {
                    wp_send_json_success('Student updated successfully.');
                }
            }
        } else {
            wp_send_json_error('No data provided for update.');
        }


    }

    // Deleting Student
    elseif (isset($_POST['action_type']) && $_POST['action_type'] === 'delete_student') {
        $id = intval($_POST['id']);

        $deleted = $wpdb->delete(
            $table_student,
            array('id' => $id),
            array('%d')
        );

        if ($deleted) {
            echo 'Student deleted successfully!';
        } else {
            echo 'Error deleting student!';
        }
    } else {
        echo 'Invalid action!';
    }

    wp_die(); 
}

add_action('wp_ajax_submit_student_form', 'submit_student_form');
add_action('wp_ajax_nopriv_submit_student_form', 'submit_student_form');



//Marks Section Starts

/**
 * Enqueue JavaScript for AJAX
 */
function enqueue_marks_script() {
    wp_enqueue_script('marks-script', get_template_directory_uri() . '/Management-System/Marks/marks-script.js', array('jquery'), null, true);
    
    wp_localize_script('marks-script', 'ajax_marks', array(
        'marks_ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_marks_script');

/**
 * Handle AJAX requests
 */
function submit_marks_form() {
    global $wpdb;
	$table_student = $wpdb->prefix . 'student';
    $table_marks = $wpdb->prefix . 'marks'; 
	$table_subject = $wpdb->prefix . 'subject';

    // Creating Coordinator
    if (isset($_POST['action_type']) && $_POST['action_type'] === 'create_marks') {
        $student_id = $_POST['student_id'];
        $subject_id = $_POST['subject_id'];
		$marks = $_POST['marks']; 

		$subject_exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_subject WHERE id = %d", $subject_id));

		if($subject_exists){
			$inserted = $wpdb->insert($table_marks,
			array(
				'student_id' => $student_id,
				'subject_id' => $subject_id,
				'marks' => $marks
			),
			array('%d', '%d', '%d')
		);
		}
        echo 'Marks added successfully!';
    }

// Deleting Course
elseif (isset($_POST['action_type']) && $_POST['action_type'] === 'delete_marks') {
	$id = intval($_POST['id']);

	$wpdb->delete($table_marks,
		array('id' => $id), 
		array('%d')
	);
	echo 'Relation deleted successfully!';
} else {
	echo 'Invalid action!';
}


    wp_die(); 
}

add_action('wp_ajax_submit_marks_form', 'submit_marks_form');
add_action('wp_ajax_nopriv_submit_marks_form', 'submit_marks_form'); 


//Marks Edit 
/**
 * Enqueue JavaScript for AJAX
 */
function enqueue_marksEdit_script() {
    wp_enqueue_script('marksEdit-script', get_template_directory_uri() . '/Management-System/Marks/marksEdit-script.js', array('jquery'), null, true);
    
    wp_localize_script('marksEdit-script', 'ajax_marksEdit_object', array(
        'marksEdit_ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_marksEdit_script');

/**
 * Handle AJAX requests
 */
function marksEdit() {
    global $wpdb;
    $table_course = $wpdb->prefix . 'course'; 
    $table_coordinator = $wpdb->prefix . 'coordinator';

    // Creating Course
    if (isset($_POST['action_type']) && $_POST['action_type'] === 'create_course') {
        $course_name = sanitize_text_field($_POST['course_name']);
        $course_code = sanitize_text_field($_POST['course_code']);
        $coordinator_id = intval($_POST['coordinator_id']); 

        $coordinator_exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table_coordinator WHERE id = %d", $coordinator_id));

        if($coordinator_exists){
            $inserted = $wpdb->insert($table_course,
                array(
                    'course_name' => $course_name,
                    'course_code' => $course_code,
                    'coordinator_id' => $coordinator_id
                ),
                array('%s', '%s', '%d')
            );

            if ($inserted) {
                echo 'Course added successfully!';
            } else {
                echo 'Failed to add course.';
            }
        } else {
            echo 'Coordinator does not exist.';
        }
    } else {
        echo 'Invalid action type.';
    }

    wp_die(); // Terminate AJAX request properly
}

add_action('wp_ajax_marksEdit', 'marksEdit');
add_action('wp_ajax_nopriv_marksEdit', 'marksEdit');
 

