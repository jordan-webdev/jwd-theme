<?php
// Add custom CSS to wp-admin
// https://css-tricks.com/snippets/wordpress/apply-custom-css-to-admin-area/

add_action('admin_head', 'admin_custom_css');

function admin_custom_css() {
  echo '<style>
    .acf-repeater.-block > table > tbody > tr > td {
      border-width: 31px 0 0 1px;
    }

    .wysiwyg-small .mce-edit-area{
      height: 80px;
      min-height: 80px;
    }

		.textarea-small textarea{
			height: 50px;
      min-height: 50px;
		}

    .acf-button{
      position: relative;
    }
  </style>';
}
