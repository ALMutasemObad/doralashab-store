<?php
get_header();
$services = array(
	array( 'book', 'تقييم المخطوط', 'قراءة أولية تحدد احتياجات المحتوى والمسار الأنسب قبل بدء الإنتاج.' ),
	array( 'pen', 'التحرير والتدقيق', 'تحرير بنيوي ولغوي وتدقيق يرفع الوضوح ويحافظ على صوت المؤلف.' ),
	array( 'catalog', 'التصميم والإخراج', 'غلاف وهوية بصرية وتنسيق داخلي يقدمان الكتاب بصورة متماسكة.' ),
	array( 'inventory', 'التجهيز للإنتاج', 'مراجعة الملفات والمواصفات الفنية والنسخ النهائية قبل الطباعة.' ),
	array( 'boxes', 'الطباعة والتوريد', 'اختيار الخامات والمقاس والتجليد والكميات ومتابعة جودة المنتج.' ),
	array( 'library', 'النشر والتوزيع', 'تهيئة بيانات الإصدار وإدارة قنوات الوصول إلى المكتبات والقراء.' ),
);
?>
<section class="da-inner-hero"><div class="da-container"><div><p class="da-kicker da-kicker--light">خدمات النشر والإنتاج</p><h1>كتابك ليس ملفًا للطباعة؛ إنه تجربة كاملة.</h1><p>نرافق المؤلف والجهة في بناء كتاب متماسك المحتوى والهوية، جاهز للإنتاج والوصول إلى قارئه.</p></div><div class="da-inner-hero-card"><strong>مسار مصمم لكل كتاب</strong><span>نحدد الخدمات بعد فهم نوع الكتاب، جمهوره، جاهزية المخطوط، والنتيجة التي تريد الوصول إليها.</span></div></div></section>
<section class="da-section da-section--white"><div class="da-container"><div class="da-section-heading"><div><p class="da-kicker">من الفكرة إلى الرف</p><h2>خدمات مترابطة تحمي جودة المنتج النهائي</h2></div><p>يمكن طلب مرحلة محددة أو إدارة المسار كاملًا وفق نطاق عمل واضح.</p></div><div class="da-feature-grid">
	<?php foreach ( $services as $service ) : ?><article class="da-feature-card" data-reveal><span class="da-service-icon"><?php doralashab_icon( $service[0] ); ?></span><h3><?php echo esc_html( $service[1] ); ?></h3><p><?php echo esc_html( $service[2] ); ?></p></article><?php endforeach; ?>
</div></div></section>
<section class="da-section"><div class="da-container"><div class="da-workflow-grid" data-reveal><div class="da-workflow-step"><span>01</span><strong>استلام وتقييم</strong><p>نفهم المشروع ونراجع المادة ونحدد الفجوات.</p></div><div class="da-workflow-step"><span>02</span><strong>تحرير وهوية</strong><p>نعمل على المحتوى والغلاف والإخراج كمنظومة.</p></div><div class="da-workflow-step"><span>03</span><strong>إنتاج ومراجعة</strong><p>نجهز الملفات ونراجع العينات والمواصفات.</p></div><div class="da-workflow-step"><span>04</span><strong>نشر ووصول</strong><p>نرتب بيانات الإصدار والطباعة والتوزيع.</p></div></div></div></section>
<?php get_footer(); ?>
