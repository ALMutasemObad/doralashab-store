<?php
get_header();

$services = array(
	array( 'boxes', 'التوريد وتنمية المجموعات', 'اختيار مصادر المعرفة وبناء القوائم وتنسيق التوريد وفق الفئات والتخصصات ونطاق المشروع.' ),
	array( 'inventory', 'الجرد والتعشيب والفحص', 'حصر المقتنيات ومراجعة حالتها وإعداد كشوف المواد المقترح معالجتها أو استبعادها وفق اعتماد الجهة.' ),
	array( 'catalog', 'الفهرسة والتصنيف', 'إعداد البيانات وتنظيم المقتنيات بما يحسن الاسترجاع والوصول إلى المواد.' ),
	array( 'barcode', 'الترميز والتجهيز الفني', 'باركود وملصقات كعب وأختام وتجهيز بحسب متطلبات المشروع والنظام المعتمد لدى الجهة.' ),
	array( 'library', 'إجراءات التشغيل', 'تنظيم دورة العمل والخدمة والإعارة بما يتناسب مع بيئة المكتبة وطبيعة المستفيدين.' ),
	array( 'layers', 'إدارة التنفيذ والتسليم', 'تحويل الاحتياج إلى نطاق وخطة ومخرجات، وتنسيق الفحص والتسليم والتوصيات الختامية.' ),
);

$deliverables = array( 'نطاق وخطة تنفيذ', 'قوائم مصادر أو مواد', 'سجلات تجهيز وبيانات', 'كشوف فحص وملاحظات', 'محاضر استلام وتسليم', 'توصيات تشغيل ومتابعة' );
?>

<section class="da-inner-hero da-inner-hero--paper" aria-labelledby="library-title">
	<div class="da-container da-inner-hero-layout">
		<div data-reveal><p class="da-kicker">حلول المكتبات والمؤسسات</p><h1 id="library-title"><span>حلول مكتبية منظمة</span><span>وقابلة للتشغيل</span></h1><p>نبني الخدمة حول المجموعة وإجراءات العمل وتجربة المستفيد، مع نطاق واضح ومخرجات تناسب طبيعة كل جهة.</p><div class="da-hero-actions"><a class="da-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">اطلب دراسة احتياجك <?php doralashab_icon( 'arrow' ); ?></a></div></div>
		<div class="da-inner-principle" data-reveal><span><?php doralashab_icon( 'quality' ); ?></span><p class="da-kicker">مبدأ العمل</p><strong>الجودة إجراء ممتد، وليست مراجعة أخيرة</strong><small>نحدد المواصفات والمخرجات ومعايير القبول قبل التنفيذ، ثم نراجع المطابقة حتى التسليم.</small></div>
	</div>
</section>

<section class="da-section da-section--white">
	<div class="da-container">
		<div class="da-section-heading" data-reveal><div><p class="da-kicker">منظومة الخدمة</p><h2>ما تحتاجه المكتبة خلال دورة حياتها</h2></div><p>يمكن تنفيذ خدمة محددة أو بناء مسار مترابط وفق نطاق المشروع واعتماد الجهة.</p></div>
		<div class="da-feature-grid">
			<?php foreach ( $services as $service ) : ?><article class="da-feature-card" data-reveal><span class="da-service-icon"><?php doralashab_icon( $service[0] ); ?></span><h3><?php echo esc_html( $service[1] ); ?></h3><p><?php echo esc_html( $service[2] ); ?></p></article><?php endforeach; ?>
		</div>
	</div>
</section>

<section class="da-section da-quality-section">
	<div class="da-container da-quality-grid">
		<div data-reveal><p class="da-kicker">ضبط الجودة والتوثيق</p><h2>وضوح يمكن مراجعته في كل مرحلة</h2><p>نربط جودة التنفيذ بأثر واضح داخل المشروع: مواصفات محددة، مراجعة للمطابقة، توثيق للملاحظات، وتسليم منظم.</p></div>
		<div class="da-quality-list" data-reveal><div><strong>01</strong><span><b>معايير واضحة</b><small>مواصفات ومخرجات ومعايير قبول قبل بدء العمل.</small></span></div><div><strong>02</strong><span><b>فحص ومطابقة</b><small>مراجعة المواد والبيانات والتجهيز وفق النطاق.</small></span></div><div><strong>03</strong><span><b>توثيق مرحلي</b><small>تسجيل الإنجاز والملاحظات والقرارات خلال التنفيذ.</small></span></div><div><strong>04</strong><span><b>تسليم منظم</b><small>كشوف وسجلات تدعم الفحص والاستلام والتشغيل.</small></span></div></div>
	</div>
</section>

<section class="da-section da-library-deliverables">
	<div class="da-container da-deliverables da-deliverables--page" data-reveal>
		<div class="da-deliverables-copy"><p class="da-kicker da-kicker--light">مخرجات المشروع</p><h2>ما الذي يمكن أن تستلمه الجهة؟</h2><p>تتحدد المخرجات بحسب طبيعة المشروع ونطاقه، وقد تشمل:</p></div>
		<div class="da-deliverables-grid"><?php foreach ( $deliverables as $item ) : ?><span><?php doralashab_icon( 'check' ); ?><strong><?php echo esc_html( $item ); ?></strong></span><?php endforeach; ?></div>
	</div>
</section>

<?php get_footer(); ?>
