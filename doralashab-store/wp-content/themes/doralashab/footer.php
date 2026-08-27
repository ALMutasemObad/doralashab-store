</main>
<?php
$show_project_cta = true;
if ( function_exists( 'is_cart' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
	$show_project_cta = false;
}
?>
<?php if ( $show_project_cta ) : ?>
	<section class="da-cta" aria-labelledby="footer-cta-title">
		<div class="da-container">
			<div><span class="da-cta-kicker">ابدأ من احتياجك</span><h2 id="footer-cta-title">لنبدأ مشروع المعرفة التالي</h2><p>للنشر، أو توريد الكتب، أو حلول المكتبات والمؤسسات؛ نبني معك المسار المناسب.</p></div>
			<a class="da-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">ناقش مشروعك معنا <?php doralashab_icon( 'arrow' ); ?></a>
		</div>
	</section>
<?php endif; ?>
<footer class="site-footer">
	<div class="da-container footer-grid">
		<div class="footer-brand">
			<a class="footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="العودة إلى الصفحة الرئيسية">
				<?php if ( file_exists( get_template_directory() . '/assets/images/logo.png' ) ) : ?><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="شركة دور الأصحاب للنشر والتوزيع" width="435" height="184"><?php endif; ?>
			</a>
			<p>نصنع الكتاب، ونقرّبه من قارئه، ونقدّم للمؤسسات والمكتبات حلولاً معرفية متقنة.</p>
			<div class="footer-brand-signature"><span>نشر</span><span>توزيع</span><span>حلول مؤسسية</span></div>
		</div>
		<div class="footer-links-cluster" aria-label="روابط الموقع والخدمات">
			<div class="footer-column footer-links-column"><h2>تصفح</h2><ul><li><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">كل الكتب</a></li><li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">عن الشركة</a></li><li><a href="<?php echo esc_url( home_url( '/#institutional-presence' ) ); ?>">حضورنا المؤسسي</a></li><li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">تواصل معنا</a></li></ul></div>
			<div class="footer-column footer-links-column"><h2>خدماتنا</h2><ul><li><a href="<?php echo esc_url( home_url( '/publishing-services/' ) ); ?>">النشر والإنتاج المعرفي</a></li><li><a href="<?php echo esc_url( home_url( '/#services' ) ); ?>">التوزيع وتوريد الكتب</a></li><li><a href="<?php echo esc_url( home_url( '/library-services/' ) ); ?>">حلول المكتبات</a></li><li><a href="<?php echo esc_url( home_url( '/library-services/' ) ); ?>">الخدمات الفنية والتشغيل</a></li></ul></div>
		</div>
		<div class="footer-column footer-contact">
			<h2>تواصل معنا</h2>
			<ul>
				<li><span class="footer-contact-icon"><?php doralashab_icon( 'pin' ); ?></span><span><small>الموقع</small><strong>الرياض – حي الروابي</strong></span></li>
				<li><span class="footer-contact-icon"><?php doralashab_icon( 'phone' ); ?></span><span><small>الهاتف</small><a href="tel:+966555104300" dir="ltr">+966 55 510 4300</a></span></li>
				<li><span class="footer-contact-icon"><?php doralashab_icon( 'mail' ); ?></span><span><small>البريد</small><a href="mailto:alas3hab@gmail.com" dir="ltr">alas3hab@gmail.com</a></span></li>
			</ul>
		</div>
	</div>
	<div class="footer-bottom"><div class="da-container"><span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> شركة دور الأصحاب للنشر والتوزيع. جميع الحقوق محفوظة.</span><span>نعتني بالتفاصيل لأن المعرفة تستحق.</span></div></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
