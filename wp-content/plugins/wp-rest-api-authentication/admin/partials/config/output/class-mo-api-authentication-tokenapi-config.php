<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       miniorange
 * @since      1.0.0
 *
 * @package    Miniorange_api_authentication
 * @subpackage Miniorange_api_authentication/admin/partials
 */

class Mo_API_Authentication_Admin_TokenAPI_Config {

	public static function mo_api_auth_configuration_output() {
	?>
	<div id="mo_api_authentication_support_layout" class="mo_api_authentication_support_layout">
	<div id="mo_api_authentication_support_tokenapi" class="mo_api_authentication_common_div_css">
		<div>
			<h3>Universal API Key: </h3>
			<h4>You can use the below API key to authenticate your WordPress REST APIs.</h4>
			<table class="mo_api_authentication_settings_table">
				<tr>
					<td style="vertical-align:top"><h4 style="font-size:16px;margin-top:15px;">API Key : </h4></td>
					<td>
						<p id="generate_token_success_message" style="color:green;display:none">New Token is generated</p>
						<div class="mo_api_auth_bearer_token_button_wrap">
							<input id="mo_api_auth_bearer_token" type="password" class="mo_api_auth_bearer_token_input" readonly placeholder="Please click below button to Generate API Key" value="<?php echo esc_attr( get_option('mo_api_auth_bearer_token') ); ?>">
							<button onclick="showAPIKey()" class="mo_api_auth_bearer_token_show_button">Show</button>
						</div>
						<br>
						<a id="regeneratetoken" name="action" style="cursor:pointer;font-size:14px" onclick="regenerateAndCopyToken()"><b>Generate New Key</b></a>
				</td>
				</tr>
			</table>
		</div>
	</div>
	</div>
	<br>
	<div id="mo_api_authentication_support_layout" class="mo_api_authentication_support_layout">
	<div id="mo_api_authentication_support_tokenapi" class="mo_api_authentication_common_div_css">
		<div>
			<h3>Create User Specific API Keys <a href="admin.php?page=mo_api_authentication_settings&tab=licensing" target="_blank" rel="noopener noreferrer" style="font-size: small">[PREMIUM]</a>: </h3>
			<h4>Select the User from your WordPress database to create a new API Key.</h4>
			<table class="mo_api_authentication_settings_table">
				<tr>
					<td style="vertical-align:top"><h4 style="font-size:16px;margin-top:15px;">WordPress Username : </h4></td>
					<td>	
						<?php $users = get_users();?>
						<select readonly style="width:100%;margin-top:15px">
						$count = 0;
						<?php foreach($users as $user){
							$count++;
							if($count==11){
								break;
							}
						?>
							<option><?php echo esc_attr( $user->user_login ); ?></option>
						<?php
						} ?>
						</select>
						<br>
						<button disabled style="margin-top:15px; width:170px;" class="button button-primary button-large">Create API Key</button>
				</td>
				</tr>
			</table>
		</div>
	</div>
	</div>
	<br/>
	<div id="mo_api_authentication_support_layout" class="mo_api_authentication_support_layout">
	<div class="mo_api_authentication_common_div_css">
		<h3>API Reference for Token API : <u><b><small><a href="https://plugins.miniorange.com/rest-api-key-authentication-method" target="_blank" style="color: red">[SETUP GUIDE]</a></small></b></u></h4>
		<table class="mo_api_authentication_settings_table">
			<tr>
				Once you generate the API Key (token), you can access WP REST API's like below.<br><br>
			</tr>
		</table>
		<div class="row">
			<div class="mo_api_authentication_box">
				<div class="mo_api_authentication_box_header">
					<h4 class="mo_api_authentication_box_heading"><span class="mo_api_authentication_request_button">get</span> /wp-json/wp/v2/posts </h4>				
				</div>
				<div class="mo_api_authentication_box_body">
					<div class="mo_api_authentication_box_body_text">
						<p>
							Request all WordPress Posts
						</p>
					</div>
					<div class="mo_api_authentication_box_white_section">
						<h5 class="mo_api_authentication_box_white_section_heading">Header</h5>
					</div>
					<br>
					<div class="mo_api_authentication_box_body_text">
						<table class="mo_api_authentication_settings_table">
							<thead>
								<th style="text-align:left">Name</th>
								<th style="text-align:left">Value</th>
							</thead>
							<tbody>
								<tr>
									<td>
										<hr>
									</td>
									<td>
										<hr>
									</td>
								</tr>
								<tr>
									<td>Authorization</td>
									<td>Bearer < token ></td>
								</tr>
							</tbody>
						</table>
					</div>
					<br>
					<div class="mo_api_authentication_box_white_section">
						<h5 class="mo_api_authentication_box_white_section_heading">Responses</h5>
					</div>
					<br>
					<div class="mo_api_authentication_box_body_text">
						<table class="mo_api_authentication_settings_table">
							<thead>
								<th style="text-align:left">Code</th>
								<th style="text-align:left">Description</th>
							</thead>
							<tbody>
								<tr>
									<td>
										<hr>
									</td>
									<td>
										<hr>
									</td>
								</tr>
								<tr>
									<td style="vertical-align:baseline"><b>200</b></td>
									<td>
										<div class="mo_api_authentication_code_output">Successful response</div>
										<p>Sample response</p>
										<div class="mo_api_authentication_code_output">
										[{<br>
											"id":1,<br>
											"slug":"hello-world",<br>
											"status":"publish",<br>
											"type":"post",<br>
											"link":"http://< wp_base_url >/hello-world/",<br>
											"title":{<br>
												"rendered":"Hello World"<br>
												},<br>
											"content":{<br>
												"rendered":"\nWelcome to WordPress. This is your first post. Edit or delete it, then start writing!\n",<br>
												"protected":false<br>
												},<br>
												...<br>												
										}]
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<hr>
									</td>
									<td>
										<hr>
									</td>
								</tr>
								<tr>
									<td style="vertical-align:baseline"><b>401</b></td>
									<td>
										<div class="mo_api_authentication_code_output">Invalid API Key</div>
										<p>Sample response</p>
										<div class="mo_api_authentication_code_output">
										{<br>
											"status":"error",<br>
											"error":"INVALID_API_KEY",<br>
											"code":"401",<br>
											"error_description":"Sorry, you are using invalid API Key."<br>
										}
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<hr>
									</td>
									<td>
										<hr>
									</td>
								</tr>
								<tr>
									<td style="vertical-align:baseline"><b>401</b></td>
									<td>
										<div class="mo_api_authentication_code_output">Missing Authorization Header</div>
										<p>Sample response</p>
										<div class="mo_api_authentication_code_output">
										{<br>
											"status":"error",<br>
											"error":"MISSING_AUTHORIZATION_HEADER",<br>
											"code":"401",<br>
											"error_description":"Authorization header not received. Either authorization header was not sent or it was removed by your server due to security reasons."<br>
										}
										</div>
										<p><b>NOTE:</b> This error may occur because of server environment,If Apache server then put the below line in your <b>htaccess</b> file after the RewriteBase.</p>
										<code class="mo_api_authentication_code_output">
											RewriteCond %{HTTP:Authorization} ^(.*)<br>
											RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
										</code>
										<p>If NGINX server then put the below line in your <b>conf</b> file.</p>
										<code class="mo_api_authentication_code_output">
											add_header Access-Control-Allow-Headers "Authorization";
										</code>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<br>
					<div class="mo_api_authentication_box_white_section">
						<h5 class="mo_api_authentication_box_white_section_heading">Example</h5>
					</div>
					<br>
					<div class="mo_api_authentication_box_body_text">
						<table class="mo_api_authentication_settings_table">
							<thead>
								<th style="text-align:left">Request</th>
								<th style="text-align:left">Format</th>
							</thead>
							<tbody>
								<tr>
									<td>
										<hr>
									</td>
									<td>
										<hr>
									</td>
								</tr>
								<tr>
									<td><b>Curl</b></td>
									<td>
										curl -H "Authorization:Bearer <?php if(get_option('mo_api_auth_bearer_token') == false) echo '<b>&lt;token&gt;</b>'; else echo esc_attr( get_option('mo_api_auth_bearer_token') ); ?>" -X GET <?php echo esc_url( get_home_url() );?>/wp-json/wp/v2/posts
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>

	<script>

		function showAPIKey(){
			document.getElementById('mo_api_auth_bearer_token').type = 'textbox';
		}

			
		function regenerateAndCopyToken() {
			var data = {
				'action': 'regenerate_token',
			};

			jQuery.post(ajaxurl, data, function(response) {
				document.getElementById('generate_token_success_message').style.display = "block";
				mo_api_auth_bearer_token.value = response;
				mo_api_auth_bearer_token = document.getElementbyId("mo_api_auth_bearer_token");
			});
		}
	</script>
	<?php
	}
}