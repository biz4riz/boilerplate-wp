
		<aside class="sidebar" role="complementary">
		
			<?php if ( is_active_sidebar( 'Default Sidebar' ) ) : ?>

				<?php dynamic_sidebar( 'Default Sidebar' ); ?>

			<?php else : ?>

				<p>This theme has sidebar widget support, but there are no active widgets :(</p>

			<?php endif; ?>
			
			<form>
				<p>
					<label for="name">Name</label>
					<input type="text" name="name" id="name" />
				</p>
				<p>
					<label for="Email">Email</label>
					<input type="text" name="email" id="email" />
				</p>
				<p>
					<label for="comments">Comments</label>
					<textarea></textarea>
				</p>
				<p>
					<input type="submit" value="Submit" class="btn" />
				</p>
			</form>
		</aside>
		