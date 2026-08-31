<?php get_header(); ?>

<section class="da-inner-hero da-inner-hero--paper da-contact-hero" aria-labelledby="contact-title">
	<div class="da-container da-inner-hero-layout">
		<div data-reveal>
			<h1 id="contact-title"><span>لنبدأ مشروع المعرفة</span><span>التالي</span></h1>
			<p class="da-kicker">تواصل معنا</p>
			<p>للنشر، أو توريد الكتب، أو حلول المكتبات والمؤسسات؛ ابدأ باحتياجك وسنبني معه المسار المناسب.</p>
		</div>
		<div class="da-contact-hero-note" data-reveal><span><?php doralashab_icon( 'document' ); ?></span><strong>رسالة واضحة تختصر الطريق</strong><p>اذكر نوع المشروع والجهة والخدمة المطلوبة، وسيتواصل معك الفريق لمناقشة الخطوة التالية.</p></div>
	</div>
</section>

<section class="da-section da-section--white">
	<div class="da-container">
		<div class="da-contact-grid" data-reveal>
			<a class="da-contact-card" href="https://maps.google.com/?q=الرياض+حي+الروابي" target="_blank" rel="noopener"><span><?php doralashab_icon( 'pin' ); ?></span><small>الموقع</small><strong>الرياض – حي الروابي</strong></a>
			<a class="da-contact-card" href="tel:+966555104300"><span><?php doralashab_icon( 'phone' ); ?></span><small>الهاتف</small><strong dir="ltr">+966 55 510 4300</strong></a>
			<a class="da-contact-card" href="mailto:alas3hab@gmail.com"><span><?php doralashab_icon( 'mail' ); ?></span><small>البريد الإلكتروني</small><strong dir="ltr">alas3hab@gmail.com</strong></a>
			<a class="da-contact-card" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span><?php doralashab_icon( 'globe' ); ?></span><small>المتجر الإلكتروني</small><strong dir="ltr">shop.doralashab.com</strong></a>
		</div>
	</div>
</section>

<section class="da-section da-contact-projects">
	<div class="da-container">
		<div class="da-section-heading" data-reveal><div><h2>اختر نقطة البداية الأقرب لاحتياجك</h2><p class="da-kicker">كيف يمكننا مساعدتك؟</p></div><p>يمكن أن يبدأ التواصل بفكرة كتاب، أو قائمة توريد، أو احتياج مكتبة ومشروع مؤسسي.</p></div>
		<div class="da-contact-service-grid">
			<article data-reveal><span><?php doralashab_icon( 'pen' ); ?></span><h3>مشروع نشر</h3><p>مخطوط أو محتوى يحتاج إلى تقييم وإنتاج ونشر وتوزيع.</p><a href="mailto:alas3hab@gmail.com?subject=مشروع%20نشر">ناقش مشروع النشر <?php doralashab_icon( 'arrow' ); ?></a></article>
			<article data-reveal><span><?php doralashab_icon( 'boxes' ); ?></span><h3>توريد كتب</h3><p>قائمة مصادر أو احتياج مؤسسي لكتب عربية أو أجنبية.</p><a href="mailto:alas3hab@gmail.com?subject=طلب%20توريد%20كتب">ناقش طلب التوريد <?php doralashab_icon( 'arrow' ); ?></a></article>
			<article data-reveal><span><?php doralashab_icon( 'library' ); ?></span><h3>حلول مكتبة</h3><p>تجهيز أو تطوير أو جرد أو تعشيب أو خدمات فنية للمكتبة.</p><a href="mailto:alas3hab@gmail.com?subject=حلول%20مكتبات">ناقش احتياج المكتبة <?php doralashab_icon( 'arrow' ); ?></a></article>
		</div>
		<?php if ( shortcode_exists( 'doralashab_contact' ) ) : ?><div class="da-contact-form" data-reveal><?php echo do_shortcode( '[doralashab_contact]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div><?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
