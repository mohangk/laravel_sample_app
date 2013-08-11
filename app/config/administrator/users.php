<?php

/**
 * User model config
 */

return array(

	'title' => 'Users',

	'single' => 'user',

	'model' => 'User',

	/**
	 * The display columns
	 */
	'columns' => array(
		'id',
    'email',
    'name',
    'created_at',
	),

	/**
	 * The filter set
    'filters' => array(
      'id',
      'email',
      'name',
      'created_at' => array(
        'title' => 'Created at',
        'type' => 'date'
      ),
    ),
   */

	/**
	 * The editable fields
	 */
	'edit_fields' => array(
		'name' => array(
			'type' => 'text',
		),
		'email' => array(
			'type' => 'text',
		),
		'password' => array(
			'type' => 'text',
		),
	),

);
