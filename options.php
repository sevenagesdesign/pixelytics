<div class="wrap">
    <h2>
        Pixelytics Settings
    </h2>
    <div class="container">
        <ul class="tab">
            <li>
                <a class="tablinks active" href="#" onclick="openTab(event, 'analytics')">
                    Google Analytics
                </a>
            </li>
            <li>
                <a class="tablinks" href="#" onclick="openTab(event, 'pixels')">
                    Facebook Pixels
                </a>
            </li>
        </ul>
        <form action="options.php" method="post">
            <?php wp_nonce_field('update-options'); ?>
            <?php settings_fields('pixelytics'); ?>
            <div class="tabcontent" id="analytics" style="display: block;">
            	<p>Enter the web property ID found in your <a href="https://analytics.google.com/analytics/web/" target="_blank">Google Analytics dashboard</a>.</p>
            	<p>To learn more about Google Analytics, take a look at the <a href="https://www.google.com/analytics/" target="_blank">Analytics Solutions page</a>.</p>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            Web Property ID:
                        </th>
                        <td>
                            <input name="web_property_id" type="text" value="<?php echo get_option('web_property_id'); ?>" placeholder="UA-0000000-0" />
                        </td>
                    </tr>
                    <tr class="enablerow" style="border-top: 1px solid rgba(0,0,0,0.1);">
                    	<th scope="row">
							Enable Analytics:
                    	</th>
                    	<td>
                    		<input type="checkbox" name="analytics_activate" value="1" <?php checked( '1', get_option( 'analytics_activate' ) ); ?> />
                    	</td>
                    </tr>
                </table>
            </div>

            <div class="tabcontent" id="pixels">
            	<p>Enter the Pixel ID found on your <a href="https://www.facebook.com/ads/manager/pixel/facebook_pixel/" target="_blank">Facebook Pixel dashboard</a>.</p>
            	<p>If you're not sure what a Facebook Pixel is, check out the <a href="https://www.facebook.com/business/a/facebook-pixel" target="_blank">Facebook Pixel Help page.</a></p>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            Facebook Pixel ID:
                        </th>
                        <td>
                            <input name="pixel_id" type="text" value="<?php echo get_option('pixel_id'); ?>" placeholder="Enter your Pixel ID" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Enable Lead Tracking:
                        </th>
                        <td>
                            <input type="checkbox" name="pixel_lead_tracking" value="1" <?php checked( '1', get_option( 'pixel_lead_tracking' ) ); ?>>
                        </td>
                    </tr>
                    <tr class="enablerow" style="border-top: 1px solid rgba(0,0,0,0.1);">
                    	<th scope="row">
							Enable Pixels:
                    	</th>
                    	<td>
                    		<input type="checkbox" name="pixel_activate" value="1" <?php checked( '1', get_option( 'pixel_activate' ) ); ?> />
                    	</td>
                    </tr>
                </table>
            </div>
            <input name="action" type="hidden" value="update"/>
            <p class="submit">
                <input class="button-primary" type="submit" value="<?php _e('Save All Changes'); ?>"/>
            </p>
        </form>
    </div>
</div>
