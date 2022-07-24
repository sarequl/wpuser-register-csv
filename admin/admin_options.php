<?php
add_action( 'admin_menu', 'wpuser_register_csv_add_admin_menu' );
add_action( 'admin_init', 'wpuser_register_csv_settings_init' );


function wpuser_register_csv_add_admin_menu(  ) { 

	add_submenu_page( 'users.php', 'Register From CSV', 'Register From CSV', 'manage_options', 'user_register_from_csv', 'wpuser_register_csv_options_page' );

}


function wpuser_register_csv_settings_init(  ) { 

	register_setting( 'wpurc_sarequl', 'wpuser_register_csv_settings' );

	add_settings_section(
		'wpuser_register_csv_wpurc_sarequl_section', 
		__( 'Your section description', 'user-register-from-csv' ), 
		'wpuser_register_csv_settings_section_callback', 
		'wpurc_sarequl'
	);

}



function wpuser_register_csv_settings_section_callback(  ) { 

	echo __( 'User Register Dashboard', 'user-register-from-csv' );

}


function wpuser_register_csv_options_page(  ) { 

	?>
	<style>
		.csv_btn {
			margin-top: 15px;
		}
		.alart.alart-success {
			margin: 10px 0px;
			font-size: 15px;
			color: #2aaf2a;
			font-weight: 600;
			width: 10%;
		}
		.wpurc-importer-area b {
			color: #2271b1;
		}
	</style>
	<div class="wpurc-importer-area">
		<h2>User Register From CSV - Options</h2>
	<?php 
			function wpuser_register_csv_import_csv($csvfile){
				$csv_users = array_map('str_getcsv', file($csvfile));
				//return $csv_users;
				
				$new_users_data= []; //empty array to push organized data

				/**
				 * Loop through csv file and push data to new array
				 */
				for ($i=0; $i < count($csv_users); $i++) { 

					if(!empty($csv_users[$i][0])){
						$new_users_data[$i]['user_login'] = $csv_users[$i][0];
					}

					if(!empty($csv_users[$i][1])){
						$new_users_data[$i]['user_email']	= $csv_users[$i][1];
					}

					if(!empty($csv_users[$i][2])){
						$new_users_data[$i]['user_pass'] = $csv_users[$i][2];
					}

					if(!empty($csv_users[$i][3])){
						$new_users_data[$i]['first_name'] = $csv_users[$i][3];
					}

					if(!empty($csv_users[$i][4])){
						$new_users_data[$i]['last_name']	= $csv_users[$i][4];
					}

					if(!empty($csv_users[$i][5])){
						$new_users_data[$i]['role']	= $csv_users[$i][5];
					}
				}

				/*remove header*/
				unset($new_users_data[0]); 

				/**
				 * register user
				 */
				foreach($new_users_data as $user){
					$user_id = wp_insert_user($user);

					if(!is_wp_error($user_id)){
						echo '<p>User <b>'.esc_html($user['user_login']).' </b> created successfully</p>';
					}
				}
				/**
				 * register user end
				 */
			}


			if(isset($_POST['wpuser_register_csv_import_button'])){
				$csv = $_FILES['csv_file']['tmp_name'];
				if(!empty($csv)){
					
					wpuser_register_csv_import_csv($csv);
					echo '<div class="alart alart-success">CSV Import Success!</div>';
				}
			}
		?>
		
			<form action="" method="post" enctype="multipart/form-data">

				<div class="ci-form-group"> 
					<input type="file" class="ci-form-control" name="csv_file" id="">
				</div>
				<div class="csv_btn">
					<input class="wpurc-btn button-primary" type="submit" name="wpuser_register_csv_import_button" value="Import"> 
				</div>

			</form>
		</div>
		
		<?php

}