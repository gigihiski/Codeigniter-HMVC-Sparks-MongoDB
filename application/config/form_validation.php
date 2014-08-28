<?php

$config['login'] = array(
						array(
							'field' => 'username',
							'label' => 'Username',
							'rules' => 'trim|required|min_length[5]'
						),
						array(
							'field' => 'password',
							'label' => 'Password',
							'rules' => 'trim|required|min_length[5]'
						)
					);
