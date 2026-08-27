<?php
get_header();

$services = array(
	array( 'book', 'تقييم المخطوط', 'قراءة أولية تحدد احتياجات المحتوى والمسار الأنسب قبل بدء الإنتاج.' ),
	array( 'pen', 'التحرير والتدقيق', 'تحرير بنيوي ولغوي وتدقيق يرفع الوضوح ويحافظ على صوت المؤلف.' ),
	array( 'catalog', 'التصميم والإخراج', 'غلاف وهوية بصرية وتنسيق داخلي يقدمان الكتاب بصورة متماسكة.' ),
	array( 'quality', 'مراجعة ما قبل الإنتاج', 'مراجعة الملفات والمواصفات والعينة قبل اعتماد الإنتاج النهائي.' ),
	array( 'inventory', 'الطباعة والإنتاج', 'اختيار المواصفات والخامات والتجليد ومتابعة جودة المنتج.' ),
	array( 'boxes', 'النشر والتوزيع', 'تهيئة بيانات الإصدار وتنظيم وصول الكتاب إلى القنوات والقراء.' ),
);
?>

<section class="da-inner-hero da-inner-hero--paper" aria-labelledby="publishing-title">
	<div class="da-container da-inner-hero-layout">
		<div data-reveal><p class="da-kicker">النشر والإنتاج المعرفي</p><h1 id="publishing-title"><span>من المخطوط</span><span>إلى القارئ</span></h1><p>نرافق الكتاب عبر مراحل مترابطة تحمي جودة المحتوى والهوية والمنتج النهائي، وتمنح المؤلف والجهة مساراً واضحاً.</p><div class="da-hero-actions"><a class="da-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">ناقش مشروع كتابك <?php doralashab_icon( 'arrow' ); ?></a></div></div>
		<div class="da-inner-principle" data-reveal><span><?php doralashab_icon( 'book' ); ?></span><p class="da-kicker">كتاب واحد · مسار متكامل</p><strong>الفكرة الجيدة تستحق إنتاجاً يرفع قيمتها</strong><small>يمكن طلب مرحلة محددة أو إدارة المسار كاملاً وفق نطاق عمل واضح.</small></div>
	</div>
</section>

<section class="da-section da-section--white">
	<div class="da-container">
		<div class="da-section-heading" data-reveal><div><p class="da-kicker">دورة الإنتاج</p><h2>خدمات مترابطة تحمي جودة الكتاب</h2></div><p>كل مرحلة تبني على التي قبلها، من تقييم المادة إلى جاهزية الإصدار ووصوله.</p></div>
		<div class="da-feature-grid">
			<?php foreach ( $services as $service ) : ?><article class="da-feature-card" data-reveal><span class="da-service-icon"><?php doralashab_icon( $service[0] ); ?></span><h3><?php echo esc_html( $service[1] ); ?></h3><p><?php echo esc_html( $service[2] ); ?></p></article><?php endforeach; ?>
		</div>
	</div>
</section>

<section class="da-section da-publishing-path">
	<div class="da-container">
		<div class="da-section-heading" data-reveal><div><p class="da-kicker">منهج التنفيذ</p><h2>قرار واضح عند كل انتقال</h2></div><p>يساعد تسلسل المراحل على ضبط التوقعات والمراجعات والاعتمادات قبل الانتقال إلى الإنتاج.</p></div>
		<div class="da-method-grid da-method-grid--five" data-reveal><article><span>01</span><h3>تقييم المخطوط</h3><p>فهم نوع الكتاب وجمهوره وجاهزية المادة.</p></article><article><span>02</span><h3>التحرير والتدقيق</h3><p>صقل المحتوى واللغة مع الحفاظ على صوت المؤلف.</p></article><article><span>03</span><h3>التصميم والإخراج</h3><p>بناء هوية بصرية وتجربة قراءة متماسكة.</p></article><article><span>04</span><h3>الطباعة والإنتاج</h3><p>اعتماد المواصفات والعينة وتجهيز المنتج النهائي.</p></article><article><span>05</span><h3>النشر والتوزيع</h3><p>تهيئة الإصدار وتنظيم وصوله إلى قنواته وقرائه.</p></article></div>
	</div>
</section>

<?php get_footer(); ?>
