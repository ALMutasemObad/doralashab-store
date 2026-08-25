<?php
get_header();

$product_count = 0;
$shop_url      = home_url( '/shop/' );
$latest        = array();

if ( class_exists( 'WooCommerce' ) ) {
	$counts        = wp_count_posts( 'product' );
	$product_count = isset( $counts->publish ) ? (int) $counts->publish : 0;
	$shop_url      = wc_get_page_permalink( 'shop' );
	$latest        = wc_get_products( array( 'status' => 'publish', 'limit' => 8, 'orderby' => 'date', 'order' => 'DESC' ) );
}

$institutional_services = array(
	array( 'boxes', 'توريد الكتب والمصادر', 'قوائم مختارة وطلبات كمية للمدارس والجامعات والمكتبات والجهات.' ),
	array( 'inventory', 'الجرد والتحقق', 'حصر المقتنيات وتدقيق السجلات وإظهار الفاقد والمكرر بحالة واضحة.' ),
	array( 'leaf', 'التعشيب وتنمية المجموعات', 'تقييم المجموعات واستبعاد ما لا يحقق سياسة المكتبة وبناء بدائل أنسب.' ),
	array( 'catalog', 'الفهرسة والتصنيف', 'وصف ببليوجرافي وتصنيف موضوعي يساعد المستفيد في الوصول السريع.' ),
	array( 'barcode', 'الترميز والتجهيز الفني', 'باركود وملصقات كعب وأختام وتغليف وتجهيز جاهز للوضع على الرف.' ),
	array( 'library', 'إدارة وتشغيل المكتبات', 'إجراءات تشغيل ومتابعة إعارة وتقارير أداء وتطوير تجربة المستفيد.' ),
);

$partners = array(
	array( 'misk.svg', 'مؤسسة الأمير محمد بن سلمان «مسك»', 'misk' ),
	array( 'king-abdulaziz-library.png', 'مكتبة الملك عبد العزيز', 'kapl' ),
	array( 'king-fahd-library.png', 'مكتبة الملك فهد', 'kfnl' ),
	array( 'riyadh-schools.svg', 'مدارس الرياض', 'riyadh-schools' ),
	array( 'downe-house-riyadh.png', 'مدارس داون هاوس', 'downe-house' ),
	array( 'alandalus-schools.svg', 'مدارس الأندلس', 'alandalus' ),
);
?>

<section class="da-hero da-hero--editorial">
	<div class="da-hero-orbit da-hero-orbit--one" aria-hidden="true"></div>
	<div class="da-hero-orbit da-hero-orbit--two" aria-hidden="true"></div>
	<div class="da-container da-hero-grid">
		<div class="da-hero-copy-wrap" data-reveal>
			<p class="da-eyebrow"><span></span> دار نشر · متجر كتب · حلول مكتبات</p>
			<h1>نصنع للمعرفة<br><em>مكانًا يليق بها.</em></h1>
			<p class="da-hero-copy">من مخطوط المؤلف إلى رف القارئ، ومن احتياج المدرسة إلى مكتبة مكتملة التجهيز؛ تجمع شركة دور الأصحاب المحتوى والخبرة والتنفيذ في رحلة واحدة دقيقة.</p>
			<div class="da-hero-actions">
				<a class="da-button da-button--light" href="<?php echo esc_url( $shop_url ); ?>">تصفح الكتب <?php doralashab_icon( 'arrow' ); ?></a>
				<a class="da-button da-button--outline" href="<?php echo esc_url( home_url( '/library-services/' ) ); ?>">حلول الجهات والمكتبات</a>
			</div>
			<div class="da-hero-proof" aria-label="مزايا شركة دور الأصحاب">
				<span><?php doralashab_icon( 'check' ); ?> إصدارات عربية مختارة</span>
				<span><?php doralashab_icon( 'check' ); ?> تنفيذ مؤسسي موثّق</span>
				<span><?php doralashab_icon( 'check' ); ?> شحن داخل المملكة</span>
			</div>
		</div>
		<div class="da-hero-visual" data-reveal>
			<div class="da-hero-image-frame">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-publishing-v2.webp' ); ?>" alt="كتاب مفتوح يمتد إلى ممر من المعرفة داخل مكتبة أنيقة">
			</div>
			<div class="da-floating-note da-floating-note--top"><span>رحلة متكاملة</span><strong>من الفكرة إلى القارئ</strong></div>
			<div class="da-floating-note da-floating-note--bottom"><strong><?php echo esc_html( max( 23, $product_count ) ); ?>+</strong><span>عنوانًا متاحًا الآن</span></div>
		</div>
	</div>
</section>

<section class="da-trustbar">
	<div class="da-container da-trust-grid">
		<div class="da-trust-item"><span class="da-trust-icon"><?php doralashab_icon( 'book' ); ?></span><div><strong>متجر كتب متخصص</strong><span>اختيار واضح وتجربة شراء سهلة</span></div></div>
		<div class="da-trust-item"><span class="da-trust-icon"><?php doralashab_icon( 'pen' ); ?></span><div><strong>نشر وإنتاج</strong><span>من تحرير المخطوط إلى الطباعة</span></div></div>
		<div class="da-trust-item"><span class="da-trust-icon"><?php doralashab_icon( 'boxes' ); ?></span><div><strong>توريد للجهات</strong><span>قوائم وكميات وتجهيز حسب الاحتياج</span></div></div>
		<div class="da-trust-item"><span class="da-trust-icon"><?php doralashab_icon( 'library' ); ?></span><div><strong>حلول مكتبات</strong><span>جرد وفهرسة وتعشيب وتشغيل</span></div></div>
	</div>
</section>

<section class="da-section da-section--white da-audiences" id="reading-paths">
	<div class="da-container">
		<div class="da-section-heading" data-reveal>
			<div><p class="da-kicker">مسارات صنعت لكل قارئ</p><h2>القراءة تبدأ مبكرًا… وتكبر مع المدرسة</h2></div>
			<p>أقسام واضحة تساعد الأسرة والمعلم وأمين المكتبة في الوصول إلى النوع المناسب من المحتوى.</p>
		</div>
		<div class="da-audience-grid">
			<a class="da-audience-card da-audience-card--children" href="<?php echo esc_url( home_url( '/childrens-books/' ) ); ?>" data-reveal>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/children-learning-v2.webp' ); ?>" alt="أطفال يقرؤون في ركن مكتبة مشرق">
				<span class="da-audience-overlay"></span>
				<span class="da-audience-content">
					<span class="da-audience-label">عوالم صغيرة… أثر كبير</span>
					<strong>كتب الأطفال</strong>
					<span>قصص مصورة · قراءة مبكرة · قيم ومعرفة</span>
					<span class="da-audience-link">اكتشف القسم <?php doralashab_icon( 'arrow' ); ?></span>
				</span>
			</a>
			<a class="da-audience-card da-audience-card--school" href="<?php echo esc_url( home_url( '/school-books/' ) ); ?>" data-reveal>
				<span class="da-school-pattern" aria-hidden="true"></span>
				<span class="da-school-content">
					<span class="da-audience-label">للمدارس والمعلمين</span>
					<strong>كتب المدارس</strong>
					<span>قراءة إثرائية ومصادر مساندة تبني مكتبة مدرسية أكثر حيوية.</span>
					<span class="da-school-tags"><i>مكتبة صفية</i><i>حقائب قراءة</i><i>مصادر للمعلم</i></span>
					<span class="da-audience-link">اعرف حلول المدارس <?php doralashab_icon( 'arrow' ); ?></span>
				</span>
				<span class="da-school-shelf" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></span>
			</a>
		</div>
	</div>
</section>

<?php if ( $latest ) : ?>
<section class="da-section da-books-section">
	<div class="da-container">
		<div class="da-section-heading" data-reveal>
			<div><p class="da-kicker">على رفوفنا الآن</p><h2>إصدارات تستحق مكانًا في مكتبتك</h2></div>
			<a class="da-text-link" href="<?php echo esc_url( $shop_url ); ?>">مشاهدة كل الكتب <?php doralashab_icon( 'arrow' ); ?></a>
		</div>
		<div class="da-products-grid" data-reveal>
			<?php foreach ( $latest as $item ) { doralashab_product_card( $item ); } ?>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="da-section da-services-section" id="library-solutions">
	<div class="da-container">
		<div class="da-services-intro" data-reveal>
			<div><p class="da-kicker da-kicker--light">حلول مؤسسية من مصدر واحد</p><h2>المكتبة الناجحة ليست رفوفًا فقط؛<br>إنها منظومة تعمل بدقة.</h2></div>
			<div><p>نساعد الجهات في بناء مجموعة مناسبة، تنظيمها، تجهيزها، ثم إدارة دورة حياتها بأدوات وإجراءات واضحة.</p><a class="da-button da-button--light" href="<?php echo esc_url( home_url( '/library-services/' ) ); ?>">تفاصيل حلول المكتبات</a></div>
		</div>
		<div class="da-institutional-grid">
			<?php foreach ( $institutional_services as $index => $service ) : ?>
			<article class="da-institutional-card" data-reveal>
				<span class="da-service-number"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
				<span class="da-service-icon"><?php doralashab_icon( $service[0] ); ?></span>
				<h3><?php echo esc_html( $service[1] ); ?></h3>
				<p><?php echo esc_html( $service[2] ); ?></p>
			</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="da-section da-section--white da-workflow">
	<div class="da-container">
		<div class="da-section-heading" data-reveal>
			<div><p class="da-kicker">منهج عمل واضح</p><h2 class="da-workflow-title">من الاحتياج إلى التسليم…<br><span>بلا مناطق رمادية</span></h2></div>
			<p>كل مشروع يمر بمراحل يمكن متابعتها وقياسها، مع مخرجات واضحة في كل خطوة.</p>
		</div>
		<div class="da-workflow-grid" data-reveal>
			<div class="da-workflow-step"><span>01</span><strong>نفهم الاحتياج</strong><p>نوع المستفيدين، حجم المجموعة، الميزانية، والسياسات المعتمدة.</p></div>
			<div class="da-workflow-step"><span>02</span><strong>نبني الخطة</strong><p>قائمة توريد أو نطاق عمل وجدول تنفيذ ومؤشرات استلام.</p></div>
			<div class="da-workflow-step"><span>03</span><strong>ننفذ ونوثّق</strong><p>تجهيز وفهرسة وجرد ومراجعة جودة مع تقارير مرحلية.</p></div>
			<div class="da-workflow-step"><span>04</span><strong>نسلّم ونتابع</strong><p>مخرجات جاهزة للاستخدام ودليل متابعة وتوصيات للتطوير.</p></div>
		</div>
		<div class="da-sector-strip" data-reveal>
			<span>نصمم الحل حسب نوع الجهة</span><i>المدارس</i><i>الجامعات</i><i>المكتبات العامة</i><i>الجهات الحكومية</i><i>مراكز التدريب</i><i>الشركات</i>
		</div>
	</div>
</section>

<section class="da-section da-partners-section" aria-labelledby="partners-title">
	<div class="da-container">
		<div class="da-partners-heading" data-reveal>
			<div>
				<p class="da-kicker">ثقة نعتز بها</p>
				<h2 id="partners-title">شركاء في صناعة الأثر والمعرفة</h2>
			</div>
			<p>جهات تشرفنا بالعمل معها في مشاريع الكتب والنشر والتوريد والخدمات المعرفية.</p>
		</div>
		<div class="da-partners-grid" data-reveal>
			<?php foreach ( $partners as $partner ) : ?>
			<article class="da-partner-card da-partner-card--<?php echo esc_attr( $partner[2] ); ?>">
				<div class="da-partner-logo-wrap">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/partners/' . $partner[0] ); ?>" alt="شعار <?php echo esc_attr( $partner[1] ); ?>" loading="lazy">
				</div>
				<h3><?php echo esc_html( $partner[1] ); ?></h3>
			</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="da-section da-publishing-section">
	<div class="da-container da-publishing-grid">
		<div class="da-publishing-copy" data-reveal>
			<p class="da-kicker">للمؤلفين ودور النشر</p>
			<h2>الفكرة الجيدة تستحق إنتاجًا يرفع قيمتها</h2>
			<p>نبني لكل كتاب مساره المناسب؛ نراجع المحتوى، نصقل اللغة، نصمم الهوية، ونجهز المنتج للنشر والطباعة والتوزيع.</p>
			<a class="da-button" href="<?php echo esc_url( home_url( '/publishing-services/' ) ); ?>">استكشف خدمات النشر <?php doralashab_icon( 'arrow' ); ?></a>
		</div>
		<div class="da-publishing-journey" data-reveal>
			<div><span><?php doralashab_icon( 'pen' ); ?></span><strong>تحرير وتدقيق</strong><small>وضوح في الفكرة وسلامة في اللغة</small></div>
			<div><span><?php doralashab_icon( 'book' ); ?></span><strong>تصميم وإخراج</strong><small>هوية بصرية وتجربة قراءة متقنة</small></div>
			<div><span><?php doralashab_icon( 'inventory' ); ?></span><strong>طباعة وإنتاج</strong><small>مواصفات مناسبة ومراجعة جودة</small></div>
			<div><span><?php doralashab_icon( 'boxes' ); ?></span><strong>نشر وتوزيع</strong><small>وصول منظم إلى القنوات والقراء</small></div>
		</div>
	</div>
</section>

<section class="da-section da-section--white">
	<div class="da-container da-about-grid da-about-grid--v2">
		<div class="da-about-mark" data-reveal>
			<span class="da-about-ring" aria-hidden="true"></span>
			<?php if ( file_exists( get_template_directory() . '/assets/images/logo.png' ) ) : ?><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="شركة دور الأصحاب للنشر والتوزيع"><?php endif; ?>
			<small>نشر · توزيع · معرفة</small>
		</div>
		<div class="da-about-copy" data-reveal>
			<p class="da-kicker">عن شركة دور الأصحاب</p>
			<h2>شريك ثقافي يرى التفاصيل التي تصنع الفرق</h2>
			<p>ننظر إلى الكتاب بوصفه محتوى وتجربة ومنتجًا يجب أن يصل إلى قارئه بصورة تليق به. لذلك نجمع العناية التحريرية، الجودة البصرية، والانضباط التشغيلي في منظومة واحدة.</p>
			<ul class="da-bullets"><li>عناية بالمحتوى واللغة</li><li>تصميم يعبّر عن الكتاب</li><li>تنفيذ مؤسسي قابل للقياس</li><li>تواصل ومتابعة واضحة</li></ul>
			<a class="da-text-link" href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">تعرف أكثر على الدار <?php doralashab_icon( 'arrow' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
