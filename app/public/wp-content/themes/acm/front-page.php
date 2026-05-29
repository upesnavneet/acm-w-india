<?php
/**
 * The template for displaying the front page
 *
 * @package WordPress
 * @subpackage ACM
 * @since ACM 1.0
 */

get_header();
?>

<!-- Hero Section -->
<div class="acmw-hero">
	<div class="acmw-hero-overlay"></div>
	<div class="row acmw-hero-content">
		<div class="columns large-8 medium-10 small-12">
			<span class="acmw-hero-tagline">ACM-W India</span>
			<h1 class="acmw-hero-title">Empowering Women in Computing</h1>
			<p class="acmw-hero-desc">
				Supporting, celebrating, and advocating for the full engagement of women in all aspects of the computing field across India. We foster research, professional growth, and education.
			</p>
			<div class="acmw-hero-actions">
				<a href="https://india.acm.org/" target="_blank" class="acmw-btn acmw-btn-primary">Join ACM-W India</a>
				<a href="#initiatives" class="acmw-btn acmw-btn-secondary">Explore Our Initiatives</a>
			</div>
		</div>
	</div>
</div>

<!-- Stats Counter Section -->
<div class="acmw-stats-bar">
	<div class="row">
		<div class="columns large-3 medium-6 small-6 text-center">
			<div class="acmw-stat-item">
				<span class="acmw-stat-number">40+</span>
				<span class="acmw-stat-label">Active Chapters</span>
			</div>
		</div>
		<div class="columns large-3 medium-6 small-6 text-center">
			<div class="acmw-stat-item">
				<span class="acmw-stat-number">2000+</span>
				<span class="acmw-stat-label">Members Across India</span>
			</div>
		</div>
		<div class="columns large-3 medium-6 small-6 text-center">
			<div class="acmw-stat-item">
				<span class="acmw-stat-number">15+</span>
				<span class="acmw-stat-label">National Events / Year</span>
			</div>
		</div>
		<div class="columns large-3 medium-6 small-6 text-center">
			<div class="acmw-stat-item">
				<span class="acmw-stat-number">1</span>
				<span class="acmw-stat-label">Unified Vision</span>
			</div>
		</div>
	</div>
</div>

<!-- Core Objectives Section -->
<div class="acmw-section acmw-bg-light" id="objectives">
	<div class="row text-center section-header">
		<div class="columns large-8 large-centered medium-10 medium-centered small-12">
			<h2 class="acmw-section-title">Our Core Objectives</h2>
			<div class="acmw-title-divider"></div>
			<p class="acmw-section-subtitle">
				ACM-W India is dedicated to promoting gender diversity and inclusion in computer science and engineering through targeted programs.
			</p>
		</div>
	</div>
	
	<div class="row">
		<div class="columns large-4 medium-4 small-12">
			<div class="acmw-card text-center">
				<div class="acmw-card-icon">
					<i class="fa fa-graduation-cap"></i>
				</div>
				<h3 class="acmw-card-title">Foster CS Education</h3>
				<p class="acmw-card-body">
					Inspiring young women and girls to pursue computing education and careers by offering hands-on bootcamps, workshops, and mentoring sessions.
				</p>
			</div>
		</div>
		<div class="columns large-4 medium-4 small-12">
			<div class="acmw-card text-center">
				<div class="acmw-card-icon">
					<i class="fa fa-users"></i>
				</div>
				<h3 class="acmw-card-title">Professional Growth</h3>
				<p class="acmw-card-body">
					Providing professional development resources, networking platforms, and mentorship circles for researchers, faculty, and industry experts.
				</p>
			</div>
		</div>
		<div class="columns large-4 medium-4 small-12">
			<div class="acmw-card text-center">
				<div class="acmw-card-icon">
					<i class="fa fa-trophy"></i>
				</div>
				<h3 class="acmw-card-title">Celebrate Success</h3>
				<p class="acmw-card-body">
					Recognizing the outstanding technical achievements of women in computing through national awards, travel scholarships, and featured spotlights.
				</p>
			</div>
		</div>
	</div>
</div>

<!-- Initiatives Section -->
<div class="acmw-section" id="initiatives">
	<div class="row section-header text-center">
		<div class="columns large-8 large-centered medium-10 medium-centered small-12">
			<h2 class="acmw-section-title">Key Initiatives & Programs</h2>
			<div class="acmw-title-divider"></div>
		</div>
	</div>

	<div class="row acmw-initiative-row">
		<div class="columns large-6 medium-6 small-12">
			<div class="acmw-initiative-content">
				<h3>Annual ACM-W India Celebration</h3>
				<p>
					The flagship event of ACM-W India bringing together women technologists, researchers, and students from all over the country. Features inspiring keynotes by world-renowned women computer scientists, panels discussing career tracks, and a national student project presentation.
				</p>
				<ul class="acmw-list">
					<li>Keynote lectures & industry panels</li>
					<li>Research posters & project showcases</li>
					<li>Networking sessions with tech leaders</li>
				</ul>
			</div>
		</div>
		<div class="columns large-6 medium-6 small-12">
			<div class="acmw-initiative-content">
				<h3>Student & Professional Chapters</h3>
				<p>
					Chapters form the local support groups that run workshops, coding competitions, guest lectures, and soft skills training. They provide a safe space for collaboration, learning, and mutual encouragement.
				</p>
				<ul class="acmw-list">
					<li>40+ student chapters across Indian universities</li>
					<li>Professional chapters in major tech hubs</li>
					<li>Mentorship programs pairing students with industry experts</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- Latest News / Blog Section -->
<div class="acmw-section acmw-bg-light">
	<div class="row section-header text-center">
		<div class="columns large-8 large-centered medium-10 medium-centered small-12">
			<h2 class="acmw-section-title">Latest Updates & Announcements</h2>
			<div class="acmw-title-divider"></div>
			<p class="acmw-section-subtitle">Stay updated with our latest activities, upcoming events, and opportunities.</p>
		</div>
	</div>

	<div class="row">
		<?php
		$latest_posts = new WP_Query( array(
			'posts_per_page' => 3,
			'post_status'    => 'publish',
		) );

		if ( $latest_posts->have_posts() ) :
			while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
				?>
				<div class="columns large-4 medium-4 small-12">
					<article class="acmw-news-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="acmw-news-img">
								<?php the_post_thumbnail( 'home-excerpt-thumbnail' ); ?>
							</div>
						<?php else : ?>
							<div class="acmw-news-img acmw-news-img-placeholder">
								<i class="fa fa-newspaper-o"></i>
							</div>
						<?php endif; ?>
						<div class="acmw-news-content">
							<span class="acmw-news-date"><?php echo get_the_date(); ?></span>
							<h3 class="acmw-news-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="acmw-news-excerpt">
								<?php the_excerpt(); ?>
							</div>
							<a href="<?php the_permalink(); ?>" class="acmw-read-more">Read More <i class="fa fa-arrow-right"></i></a>
						</div>
					</article>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
		else :
			?>
			<div class="columns small-12 text-center">
				<p>No recent news or announcements available. Check back soon!</p>
			</div>
			<?php
		endif;
		?>
	</div>
</div>

<!-- CTA Section -->
<div class="acmw-cta-section">
	<div class="row text-center">
		<div class="columns large-8 large-centered medium-10 medium-centered small-12">
			<h2>Become a Part of the ACM-W India Community</h2>
			<p>Whether you are a student, an academic, or an industry professional, your presence and support can help drive gender balance in computing.</p>
			<a href="https://india.acm.org/" target="_blank" class="acmw-btn acmw-btn-primary acmw-btn-large">Get Involved Today</a>
		</div>
	</div>
</div>

<?php
get_footer();
