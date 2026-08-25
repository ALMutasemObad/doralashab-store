<?php
get_header();
$services = array(
	array( 'boxes', 'التوريد وبناء القوائم', 'اختيار مصادر المعرفة وفق الفئة العمرية والتخصص والميزانية، ثم تجهيز أوامر الكميات والتسليم.' ),
	array( 'inventory', 'الجرد الشامل أو الانتقائي', 'مضاهاة الرفوف مع السجلات، رصد الفاقد والمكرر، وتقديم تقرير حالة قابل للتنفيذ.' ),
	array( 'leaf', 'التعشيب وتنمية المجموعات', 'مراجعة العمر العلمي والحالة المادية ومعدل الاستخدام، مع توصيات استبدال وتنمية.' ),
	array( 'catalog', 'الفهرسة والتصنيف', 'إعداد بيانات وصفية وتصنيف موضوعي ورؤوس موضوعات بما يسهل الاسترجاع والوصول.' ),
	array( 'barcode', 'التجهيز الفني والترميز', 'باركود وملصقات كعب وأختام وتغليف وحماية وتجهيز كامل قبل وضع الكتاب على الرف.' ),
	array( 'library', 'الإدارة والتشغيل', 'تطوير إجراءات الإعارة والخدمة، تنظيم فرق العمل، ولوحات متابعة وتقارير أداء دورية.' ),
);
?>
<section class="da-inner-hero">
	<div class="da-container">
		<div><p class="da-kicker da-kicker--light">حلول المكتبات والجهات</p><h1>نبني مكتبة تعمل بكفاءة… لا مجموعة كتب ساكنة.</h1><p>خدمات متكاملة من التوريد والجرد إلى الفهرسة والتشغيل، مصممة لتناسب المدارس والجامعات والمكتبات العامة والجهات.</p></div>
		<div class="da-inner-hero-card"><strong>نطاق مرن حسب المشروع</strong><span>يمكن تنفيذ خدمة واحدة، أو إدارة مشروع متكامل يبدأ بدراسة الاحتياج وينتهي بالتسليم والتدريب والتقارير.</span></div>
	</div>
</section>
<section class="da-section da-section--white"><div class="da-container"><div class="da-section-heading"><div><p class="da-kicker">خدمات قابلة للقياس</p><h2>كل ما تحتاجه المكتبة في دورة حياتها</h2></div><p>نعمل بنطاق واضح ومخرجات قابلة للاستلام والمراجعة، مع توثيق ما تم إنجازه.</p></div><div class="da-feature-grid">
	<?php foreach ( $services as $service ) : ?><article class="da-feature-card" data-reveal><span class="da-service-icon"><?php doralashab_icon( $service[0] ); ?></span><h3><?php echo esc_html( $service[1] ); ?></h3><p><?php echo esc_html( $service[2] ); ?></p></article><?php endforeach; ?>
</div></div></section>
<section class="da-section"><div class="da-container"><div class="da-page-band" data-reveal><p class="da-kicker da-kicker--light">مخرجات المشروع</p><h2>صورة واضحة قبل التنفيذ وبعده</h2><div class="da-page-deliverables"><span><?php doralashab_icon( 'check' ); ?> نطاق وقائمة أعمال</span><span><?php doralashab_icon( 'check' ); ?> تقارير الجرد والحالة</span><span><?php doralashab_icon( 'check' ); ?> ملفات بيانات وفهارس</span><span><?php doralashab_icon( 'check' ); ?> توصيات تنمية المجموعات</span><span><?php doralashab_icon( 'check' ); ?> محاضر تسليم ومراجعة جودة</span><span><?php doralashab_icon( 'check' ); ?> دليل إجراءات وتشغيل</span></div></div></div></section>
<?php get_footer(); ?>
