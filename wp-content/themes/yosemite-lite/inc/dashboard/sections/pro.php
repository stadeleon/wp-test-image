<?php
/**
 * Free vs. Pro section.
 *
 * @package Yosemite Lite
 */

?>
<div id="pro" class="gt-tab-pane">
	<table class="form-table">
		<thead>
			<tr>
				<th></th>
				<th><?php esc_html_e( 'Lite', 'yosemite-lite' ); ?></th>
				<th><?php esc_html_e( 'PRO', 'yosemite-lite' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Responsive Design', 'yosemite-lite' ); ?></h3>
					<p><?php esc_html_e( 'Works in any browsers on desktops, tablets and mobile devices and optimized for speed.', 'yosemite-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-yes"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Featured Content', 'yosemite-lite' ); ?></h3>
					<p><?php esc_html_e( 'Show your most important posts in a slider on the front page.', 'yosemite-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-yes"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Custom Logo', 'yosemite-lite' ); ?></h3>
					<p><?php esc_html_e( 'Supports custom logo in WordPress 4.5. Upload your logo has never been easier.', 'yosemite-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-yes"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( '1-Click Demo Import', 'yosemite-lite' ); ?></h3>
					<p><?php esc_html_e( 'Save time setting up the theme and get exactly what you see in the demo.', 'yosemite-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Instagram in Sidebar and Footer', 'yosemite-lite' ); ?></h3>
					<p><?php esc_html_e( 'Showing your Instagram images in the footer or sidebar in an attractive format.', 'yosemite-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Custom Google Fonts', 'yosemite-lite' ); ?></h3>
					<p><?php esc_html_e( 'Integrated all Google Fonts with various options to customize for a beautiful typography.', 'yosemite-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Custom Colors', 'yosemite-lite' ); ?></h3>
					<p><?php esc_html_e( 'Customize colors of any element on your website.', 'yosemite-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Infinite Scroll', 'yosemite-lite' ); ?></h3>
					<p><?php esc_html_e( 'Load more posts when to reach to the end of the page. Support auto mode and manual mode.', 'yosemite-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Related Posts', 'yosemite-lite' ); ?></h3>
					<p><?php esc_html_e( 'Show related posts after posting to recommend previous posts from your blog to the visitors.', 'yosemite-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td>
					<h3><?php esc_html_e( 'Priority Support', 'yosemite-lite' ); ?></h3>
					<p><?php esc_html_e( 'You will benefit of our full support for any issues you have with the theme.', 'yosemite-lite' ); ?></p>
				</td>
				<td><span class="dashicons dashicons-no"></span></td>
				<td><span class="dashicons dashicons-yes"></span></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
					<a href="<?php echo esc_url( "https://gretathemes.com/wordpress-themes/{$this->pro_slug}/{$this->utm}" ); ?>" target="_blank" class="button button-primary button-hero">
						<?php
						/* translators: pro theme name. */
						echo esc_html( sprintf( __( 'Get %s PRO now', 'yosemite-lite' ), $this->pro_name ) );
						?>
					</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
