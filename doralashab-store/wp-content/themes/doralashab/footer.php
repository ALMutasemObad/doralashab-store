</main>
<section class="da-cta">
	<div class="da-container">
		<div><span class="da-cta-kicker">ابدأ من احتياجك</span><h2>مخطوط جديد أم مشروع مكتبة متكامل؟</h2><p>فريق واحد ينسّق المحتوى والتوريد والتجهيز حتى التسليم.</p></div>
		<a class="da-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">ناقش مشروعك معنا <?php doralashab_icon( 'arrow' ); ?></a>
	</div>
</section>
<footer class="site-footer">
	<div class="da-container footer-grid">
		<div class="footer-brand">
			<a class="footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="العودة إلى الصفحة الرئيسية">
				<?php if ( file_exists( get_template_directory() . '/assets/images/logo.png' ) ) : ?><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="شركة دور الأصحاب للنشر والتوزيع"><?php endif; ?>
			</a>
			<p>نصنع الكتاب، ونقرّبه من قارئه، ونبني للمؤسسات والمكتبات حلولًا معرفية متقنة وقابلة للنمو.</p>
			<div class="footer-brand-signature"><span>نشر</span><span>توزيع</span><span>حلول مكتبات</span></div>
		</div>
		<div class="footer-column"><h2>تصفح</h2><ul><li><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>">كل الكتب</a></li><li><a href="<?php echo esc_url( home_url( '/childrens-books/' ) ); ?>">كتب الأطفال</a></li><li><a href="<?php echo esc_url( home_url( '/school-books/' ) ); ?>">كتب المدارس</a></li><li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">عن الدار</a></li></ul></div>
		<div class="footer-column"><h2>خدماتنا</h2><ul><li><a href="<?php echo esc_url( home_url( '/publishing-services/' ) ); ?>">النشر والطباعة</a></li><li><a href="<?php echo esc_url( home_url( '/library-services/' ) ); ?>">توريد الكتب</a></li><li><a href="<?php echo esc_url( home_url( '/library-services/' ) ); ?>">الجرد والتعشيب</a></li><li><a href="<?php echo esc_url( home_url( '/library-services/' ) ); ?>">الفهرسة وإدارة المكتبات</a></li></ul></div>
		<div class="footer-column footer-contact"><h2>تواصل معنا</h2><ul><li><span>الموقع</span><strong>الرياض – حي الروابي</strong></li><li><span>الهاتف</span><a href="tel:+966555104300" dir="ltr">+966 55 510 4300</a></li><li><span>البريد</span><a href="mailto:ashab4488@gmail.com">ashab4488@gmail.com</a></li></ul></div>
	</div>
	<div class="footer-bottom"><div class="da-container"><span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> شركة دور الأصحاب للنشر والتوزيع. جميع الحقوق محفوظة.</span><span>نعتني بالتفاصيل لأن المعرفة تستحق.</span></div></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
