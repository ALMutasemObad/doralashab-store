<?php
get_header();

$shop_url = home_url( '/shop/' );
$latest   = array();

if ( class_exists( 'WooCommerce' ) ) {
	$shop_url = wc_get_page_permalink( 'shop' );
	$latest   = wc_get_products(
		array(
			'status'  => 'publish',
			'limit'   => 8,
			'orderby' => 'date',
			'order'   => 'DESC',
		)
	);
}

$sectors = array(
	array( 'library', 'مكتبات عامة', 'تنمية المجموعات وتنظيمها وتحسين الوصول إلى مصادر المعرفة.' ),
	array( 'university', 'جامعات', 'مصادر أكاديمية وتوريد منظم وخدمات فنية للمكتبات الجامعية.' ),
	array( 'government', 'جهات حكومية', 'نطاقات عمل واضحة وتنفيذ منظم ومخرجات قابلة للاستلام.' ),
	array( 'school', 'مدارس', 'مصادر إثرائية ومكتبات صفية وحلول للمكتبة المدرسية.' ),
);

$services = array(
	array( 'pen', 'النشر والإنتاج المعرفي', 'تحرير وتدقيق وتصميم وإخراج وطباعة ضمن مسار إنتاج واضح.', home_url( '/publishing-services/' ) ),
	array( 'boxes', 'التوزيع وتوريد الكتب', 'بناء قوائم المصادر وتوريد الكتب العربية والأجنبية بحسب احتياج الجهة.', home_url( '/library-services/' ) ),
	array( 'library', 'تطوير وتجهيز المكتبات', 'تنمية المجموعات وتنظيمها وتجهيزها بما يناسب المستفيدين.', home_url( '/library-services/' ) ),
	array( 'inventory', 'الجرد والتعشيب والفحص', 'حصر المقتنيات وتدقيق السجلات وفحص الحالة وإعداد كشوف المراجعة.', home_url( '/library-services/' ) ),
	array( 'catalog', 'التجهيز الفني والتشغيل', 'فهرسة وتصنيف وترميز وملصقات وإجراءات تشغيل بحسب نطاق المشروع.', home_url( '/library-services/' ) ),
	array( 'layers', 'إدارة المشاريع المعرفية', 'تحويل الاحتياج إلى نطاق وخطة ومخرجات ومتابعة التنفيذ حتى التسليم.', home_url( '/contact/' ) ),
);

$workflow = array(
	array( 'نفهم الاحتياج', 'أهداف الجهة وطبيعة المستفيدين وسياق المشروع.' ),
	array( 'نحدد النطاق', 'الأعمال والمخرجات والمسؤوليات ومعايير القبول.' ),
	array( 'نبني الخطة', 'مسار التنفيذ والتوريد والمراجعة والاعتماد.' ),
	array( 'ننفذ ونراجع', 'تنفيذ منظم والتحقق من المطابقة وجودة المخرجات.' ),
	array( 'نوثق التقدم', 'كشوف وملاحظات وقرارات تحفظ وضوح المشروع.' ),
	array( 'نسلم ونتابع', 'فحص واستلام وتوصيات تدعم التشغيل والمتابعة.' ),
);

$deliverables = array(
	array( 'document', 'نطاق وخطة تنفيذ' ),
	array( 'catalog', 'قوائم ومواصفات' ),
	array( 'barcode', 'مواد وبيانات مجهزة' ),
	array( 'quality', 'كشوف وتقارير' ),
	array( 'check', 'محاضر فحص وتسليم' ),
	array( 'target', 'توصيات تشغيل ومتابعة' ),
);

$presence = array(
	array( 'king-fahd-library.png', 'مكتبة الملك فهد الوطنية', 'kfnl' ),
	array( 'imamu.png', 'جامعة الإمام محمد بن سعود الإسلامية', 'imamu' ),
	array( 'hail.png', 'جامعة حائل', 'hail' ),
	array( 'pnu.png', 'جامعة الأميرة نورة بنت عبدالرحمن', 'pnu' ),
	array( 'misk.svg', 'مؤسسة محمد بن سلمان «مسك»', 'misk' ),
	array( 'sqc.png', 'المجلس السعودي للجودة', 'sqc' ),
	array( 'riyadh-schools.svg', 'مدارس الرياض', 'riyadh-schools' ),
	array( 'downe-house-riyadh.png', 'داون هاوس الرياض', 'downe-house' ),
	array( 'alandalus-schools.svg', 'مدارس الأندلس', 'alandalus' ),
);
?>

<section class="da-seasonal-hero" aria-labelledby="home-hero-title">
	<div class="da-container da-seasonal-hero-grid">
		<div class="da-seasonal-hero-copy" data-reveal>
			<h1 id="home-hero-title"><span>في موسم الوطن…</span><span>نهيّئ للمعرفة مكانها</span></h1>
			<p class="da-seasonal-eyebrow"><span>اليوم الوطني السعودي</span><i aria-hidden="true"></i><span>العودة إلى المدارس</span></p>
			<p class="da-seasonal-brandline">شركة دور الأصحاب للنشر والتوزيع | نشر وتوزيع وحلول مؤسسية للمعرفة</p>
			<p>نجهّز مكتبات المدارس من قائمة الكتب حتى ترتيب الرفوف، ونقدّم للأسر اشتراكًا قصصيًا متجددًا يجعل القراءة موعدًا ينتظره الطفل.</p>
			<div class="da-hero-actions">
				<a class="da-button da-button--gold" href="#school-library-offer">جهّز مكتبة مدرستك <?php doralashab_icon( 'arrow' ); ?></a>
				<a class="da-button da-button--glass" href="#story-subscription">اكتشف اشتراك القصص</a>
			</div>
			<ul class="da-seasonal-points" aria-label="أبرز خدمات الموسم">
				<li><?php doralashab_icon( 'catalog' ); ?><span><strong>اختيار منظّم</strong><small>قوائم كتب بصيغة Excel</small></span></li>
				<li><?php doralashab_icon( 'library' ); ?><span><strong>تجهيز متكامل</strong><small>فهرسة وتصنيف وترتيب</small></span></li>
				<li><?php doralashab_icon( 'book' ); ?><span><strong>قراءة مستمرة</strong><small>قصص تصل إلى الأسرة دوريًا</small></span></li>
			</ul>
		</div>
		<div class="da-seasonal-hero-visual" data-reveal>
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/school-library-season.png' ); ?>" alt="مكتبة مدرسية مجهزة ومنظمة" width="1672" height="940" fetchpriority="high">
			<div class="da-seasonal-hero-card da-seasonal-hero-card--school"><span>للمدارس</span><strong>من قائمة الكتب إلى مكتبة جاهزة</strong></div>
			<div class="da-seasonal-hero-card da-seasonal-hero-card--family"><span>للأسرة</span><strong>قصة جديدة… وموعد جديد مع القراءة</strong></div>
		</div>
	</div>
	<div class="da-saudi-band da-saudi-band--seasonal">
		<div class="da-container">
			<div class="da-saudi-band-copy"><span>معرفة تمتد… وأثر يبقى</span><strong>نحتفي بالوطن بما نصنعه لأجياله</strong></div>
			<?php if ( file_exists( get_template_directory() . '/assets/images/vision-2030.png' ) ) : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/vision-2030.png' ); ?>" alt="رؤية السعودية 2030" loading="eager">
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="da-section da-seasonal-offers" id="seasonal-offers" aria-labelledby="seasonal-offers-title">
	<div class="da-container">
		<div class="da-section-heading da-section-heading--center" data-reveal>
			<h2 id="seasonal-offers-title">مساران… وغاية واحدة: أن يصبح الكتاب جزءًا من كل يوم</h2>
			<p class="da-kicker">عروض الموسم</p>
			<p>حل مؤسسي للمدرسة، وتجربة قراءة متجددة للأسرة؛ بصياغة عملية تبدأ بالاختيار وتنتهي بأثر يمكن رؤيته.</p>
		</div>

		<article class="da-seasonal-offer da-seasonal-offer--school" id="school-library-offer" data-reveal>
			<div class="da-seasonal-offer-media">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/school-library-season.png' ); ?>" alt="مكتبة مدرسية مرتبة وجاهزة للاستخدام" width="1672" height="940" loading="lazy">
				<span>عرض اليوم الوطني للمدارس</span>
			</div>
			<div class="da-seasonal-offer-copy">
				<h3>مكتبة تُبنى على احتياجكم، وتُسلَّم جاهزة للقراءة</h3>
				<p class="da-offer-audience">للمدارس والجهات التعليمية</p>
				<p class="da-offer-lead">نضع بين أيديكم ملفًا واضحًا لقوائم الكتب. تختار المدرسة العناوين والكميات، ثم نتولى التوريد والتجهيز الفني وفق نطاق العمل المعتمد.</p>
				<div class="da-offer-flow" aria-label="خطوات طلب مكتبة مدرسية">
					<span><b>01</b><strong>حمّلوا القائمة</strong><small>ملف Excel منظم وسهل التعبئة</small></span>
					<span><b>02</b><strong>حدّدوا الاختيار</strong><small>العناوين والكميات والخدمات</small></span>
					<span><b>03</b><strong>استلموا مكتبتكم</strong><small>توريد وتجهيز وترتيب وفق الاتفاق</small></span>
				</div>
				<ul class="da-offer-services">
					<li><?php doralashab_icon( 'check' ); ?> توريد الكتب المختارة</li>
					<li><?php doralashab_icon( 'check' ); ?> الفهرسة والتصنيف</li>
					<li><?php doralashab_icon( 'check' ); ?> الترميز وملصقات الكعب</li>
					<li><?php doralashab_icon( 'check' ); ?> ترتيب الكتب على الرفوف</li>
				</ul>
				<div class="da-offer-actions">
					<a class="da-button" href="<?php echo esc_url( get_template_directory_uri() . '/assets/files/school-library-book-selection.xlsx' ); ?>" download="قائمة-اختيار-كتب-المكتبة-المدرسية.xlsx"><?php doralashab_icon( 'document' ); ?> تحميل قائمة الكتب Excel</a>
					<a class="da-text-link" href="mailto:alas3hab@gmail.com?subject=%D8%B7%D9%84%D8%A8%20%D8%AA%D9%88%D8%B1%D9%8A%D8%AF%20%D9%88%D8%AA%D8%AC%D9%87%D9%8A%D8%B2%20%D9%85%D9%83%D8%AA%D8%A8%D8%A9%20%D9%85%D8%AF%D8%B1%D8%B3%D9%8A%D8%A9&amp;body=%D8%AA%D9%85%20%D8%A5%D8%B1%D9%81%D8%A7%D9%82%20%D9%82%D8%A7%D8%A6%D9%85%D8%A9%20%D8%A7%D9%84%D9%83%D8%AA%D8%A8%20%D8%A8%D8%B9%D8%AF%20%D8%AA%D8%B9%D8%A8%D8%A6%D8%AA%D9%87%D8%A7.">أرسلوا القائمة بعد تعبئتها <?php doralashab_icon( 'arrow' ); ?></a>
				</div>
				<small class="da-offer-note">يمكن طلب التوريد فقط، أو إضافة خدمات الفهرسة والتصنيف والترميز والترتيب بحسب احتياج المدرسة.</small>
			</div>
		</article>

		<article class="da-seasonal-offer da-seasonal-offer--family" id="story-subscription" data-reveal>
			<div class="da-seasonal-offer-media">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/children-learning-v2.webp' ); ?>" alt="أطفال يستمتعون بقراءة القصص" width="1400" height="933" loading="lazy">
				<span>عرض العودة إلى المدارس للأسر</span>
			</div>
			<div class="da-seasonal-offer-copy">
				<h3>اشتراكٌ يجعل للقراءة موعدًا ينتظره طفلكم</h3>
				<p class="da-offer-audience">لأولياء الأمور</p>
				<p class="da-offer-lead">قصص تُختار بما يلائم عمر الطفل واهتماماته، وتصل إلى المنزل بصورة دورية؛ لتتجدد مكتبته، وتتسع لغته وخياله، وتتحول القراءة إلى عادة محببة.</p>
				<div class="da-story-pillars">
					<span><?php doralashab_icon( 'target' ); ?><strong>اختيار ملائم</strong><small>بحسب العمر والاهتمامات</small></span>
					<span><?php doralashab_icon( 'boxes' ); ?><strong>وصول دوري</strong><small>قصص متجددة وفق الباقة</small></span>
					<span><?php doralashab_icon( 'leaf' ); ?><strong>أثر متراكم</strong><small>مكتبة تنمو مع الطفل</small></span>
				</div>
				<blockquote>ليست الفكرة أن نضيف كتابًا آخر إلى الرف، بل أن نصنع علاقة تتجدد مع كل قصة.</blockquote>
				<div class="da-offer-actions">
					<a class="da-button da-button--family" href="mailto:alas3hab@gmail.com?subject=%D8%A7%D9%87%D8%AA%D9%85%D8%A7%D9%85%20%D8%A8%D8%A7%D8%B4%D8%AA%D8%B1%D8%A7%D9%83%20%D9%82%D8%B5%D8%B5%20%D8%A7%D9%84%D8%A3%D8%B7%D9%81%D8%A7%D9%84&amp;body=%D8%B9%D9%85%D8%B1%20%D8%A7%D9%84%D8%B7%D9%81%D9%84%3A%0A%D8%A7%D9%84%D8%A7%D9%87%D8%AA%D9%85%D8%A7%D9%85%D8%A7%D8%AA%3A%0A%D8%A7%D9%84%D9%85%D8%AF%D9%8A%D9%86%D8%A9%3A">سجّلوا اهتمامكم بالاشتراك <?php doralashab_icon( 'arrow' ); ?></a>
					<a class="da-text-link" href="<?php echo esc_url( home_url( '/childrens-books/' ) ); ?>">تصفحوا كتب الأطفال</a>
				</div>
			</div>
		</article>
	</div>
</section>

<section class="da-section da-snapshot-section" id="about">
	<div class="da-container da-snapshot-grid">
		<div class="da-snapshot-copy" data-reveal>
			<h2>مسيرة سعودية<br><span>في خدمة المعرفة</span></h2>
			<p class="da-kicker">الشركة في لمحة</p>
			<p class="da-lead">بدأت شركة دور الأصحاب مسيرتها عام 1423هـ، وتطورت من دار للنشر والتوزيع إلى منظومة حلول معرفية تربط صناعة المحتوى بتوريد المصادر وتجهيز المكتبات.</p>
			<a class="da-text-link" href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">اكتشف قصة الشركة <?php doralashab_icon( 'arrow' ); ?></a>
		</div>
		<div class="da-snapshot-panel" data-reveal>
			<div class="da-snapshot-date"><span>منذ عام</span><strong>1423 هـ</strong><small>خبرة تتجاوز 23 عاماً</small></div>
			<div class="da-snapshot-list">
				<div><span><?php doralashab_icon( 'pen' ); ?></span><p><strong>صناعة المحتوى</strong><small>نشر وإنتاج معرفي</small></p></div>
				<div><span><?php doralashab_icon( 'boxes' ); ?></span><p><strong>وصول الكتاب</strong><small>توزيع وتوريد المصادر</small></p></div>
				<div><span><?php doralashab_icon( 'library' ); ?></span><p><strong>خدمة المؤسسة</strong><small>حلول للمكتبات والجهات</small></p></div>
			</div>
		</div>
	</div>
</section>

<section class="da-section da-section--white da-sector-section" aria-labelledby="sectors-title">
	<div class="da-container">
		<div class="da-section-heading da-section-heading--center" data-reveal>
			<h2 id="sectors-title">حلول تتكيّف مع طبيعة كل جهة</h2>
			<p class="da-kicker">القطاعات التي نخدمها</p>
			<p>نبني الخدمة وفق سياق الجهة وطبيعة مستفيديها ونطاق المشروع، لا وفق قالب واحد للجميع.</p>
		</div>
		<div class="da-sector-cards">
			<?php foreach ( $sectors as $index => $sector ) : ?>
				<article class="da-sector-card" data-reveal>
					<span class="da-sector-order"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
					<span class="da-sector-icon"><?php doralashab_icon( $sector[0] ); ?></span>
					<h3><?php echo esc_html( $sector[1] ); ?></h3>
					<p><?php echo esc_html( $sector[2] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="da-section da-capabilities-section" id="services" aria-labelledby="services-title">
	<div class="da-container">
		<div class="da-capabilities-heading" data-reveal>
			<div><h2 id="services-title"><span>تخدم الكتاب،</span><span>وتفهم المؤسسة.</span></h2><p class="da-kicker da-kicker--light">منظومة مترابطة</p></div>
			<p>نغطي دورة المعرفة من الفكرة والإنتاج إلى التوريد والتجهيز والتشغيل، وفق نطاق يناسب طبيعة كل مشروع.</p>
		</div>
		<div class="da-capability-grid">
			<?php foreach ( $services as $index => $service ) : ?>
				<a class="da-capability-card" href="<?php echo esc_url( $service[3] ); ?>" data-reveal>
					<span class="da-capability-top"><i><?php doralashab_icon( $service[0] ); ?></i><small><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></small></span>
					<h3><?php echo esc_html( $service[1] ); ?></h3>
					<p><?php echo esc_html( $service[2] ); ?></p>
					<span class="da-card-arrow" aria-hidden="true"><?php doralashab_icon( 'arrow' ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php if ( $latest ) : ?>
	<section class="da-section da-books-section" aria-labelledby="books-title">
		<div class="da-container">
			<div class="da-section-heading" data-reveal>
				<div><h2 id="books-title">إصدارات لقارئ يبحث عن قيمة</h2><p class="da-kicker">مختارات من المتجر</p></div>
				<div class="da-section-side"><p>كتب في الأدب والمعرفة والإدارة والتعليم ومجالات متنوعة، ضمن تجربة تصفح واضحة وسهلة.</p><a class="da-text-link" href="<?php echo esc_url( $shop_url ); ?>">مشاهدة كل الكتب <?php doralashab_icon( 'arrow' ); ?></a></div>
			</div>
			<div class="da-products-grid" data-reveal>
				<?php foreach ( $latest as $item ) { doralashab_product_card( $item ); } ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<section class="da-section da-method-section" aria-labelledby="method-title">
	<div class="da-container">
		<div class="da-section-heading" data-reveal>
			<div><h2 id="method-title" class="da-balanced-title"><span>من الاحتياج إلى التسليم…</span><span>بلا مناطق رمادية</span></h2><p class="da-kicker">منهج عمل واضح</p></div>
			<p>منهج مرحلي يوضح الأعمال والمخرجات والمسؤوليات، ويجعل الفحص والاستلام جزءاً من التنفيذ.</p>
		</div>
		<div class="da-method-grid da-method-grid--centered" data-reveal>
			<?php foreach ( $workflow as $step ) : ?>
				<article><h3><?php echo esc_html( $step[0] ); ?></h3><p><?php echo esc_html( $step[1] ); ?></p></article>
			<?php endforeach; ?>
		</div>
		<div class="da-deliverables" data-reveal>
			<div class="da-deliverables-copy"><h3>ما الذي تستلمه الجهة؟</h3><p class="da-kicker da-kicker--light">مخرجات قابلة للمراجعة والاستلام</p><p>تتحدد المخرجات بحسب طبيعة المشروع ونطاقه، وقد تشمل:</p></div>
			<div class="da-deliverables-grid">
				<?php foreach ( $deliverables as $item ) : ?><span><?php doralashab_icon( $item[0] ); ?><strong><?php echo esc_html( $item[1] ); ?></strong></span><?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section class="da-section da-presence-section" id="institutional-presence" aria-labelledby="presence-title">
	<div class="da-container">
		<div class="da-section-heading da-section-heading--center" data-reveal>
			<h2 id="presence-title">محطات في التعليم والثقافة والجودة</h2>
			<p class="da-kicker">حضور مؤسسي ومعرفي</p>
			<p>نماذج تعكس امتداد حضور الدار في سوق الكتاب والمعرفة، مع اختلاف طبيعة الحضور والتعاون من جهة إلى أخرى.</p>
		</div>
		<div class="da-presence-grid" data-reveal>
			<?php foreach ( $presence as $partner ) : ?>
				<article class="da-presence-card da-presence-card--<?php echo esc_attr( $partner[2] ); ?>">
					<div><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/partners/' . $partner[0] ); ?>" alt="<?php echo esc_attr( $partner[1] ); ?>" loading="lazy"></div>
					<h3><?php echo esc_html( $partner[1] ); ?></h3>
					<?php if ( 'imamu' === $partner[2] ) : ?><small>حضور إصدارات الدار</small><?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="da-fairs-band" data-reveal>
			<span class="da-fairs-icon"><?php doralashab_icon( 'globe' ); ?></span>
			<div><h3>مشاركة في معارض الكتاب الدولية</h3><p class="da-kicker da-kicker--light">حضور معرفي ممتد</p><p>حضور يعزز وصول الإصدارات، ويوسع قنوات التوزيع والتواصل مع الناشرين والقراء.</p></div>
		</div>
	</div>
</section>

<section class="da-founder-preview" aria-labelledby="founder-title">
	<div class="da-founder-image" aria-hidden="true"></div>
	<div class="da-container da-founder-preview-inner">
		<div class="da-founder-copy" data-reveal>
			<h2 id="founder-title">خبرة تقود<br>رؤية الدار</h2>
			<p class="da-kicker da-kicker--light">المؤسس</p>
			<p>يقود الأستاذ عبدالرحمن بن سعد العوين مسيرة تتجاوز 23 عاماً في سوق النشر والتوزيع، مع تركيز على صناعة الكتاب ووصوله إلى القارئ والمؤسسة.</p>
			<p>وترتكز رؤيته على فهم احتياجات قطاع المعرفة في المملكة، وربط جودة المحتوى بانضباط التنفيذ واستدامة الأثر.</p>
			<a class="da-button da-button--light" href="<?php echo esc_url( home_url( '/about-us/#founder' ) ); ?>">تعرّف إلى مسيرة المؤسس <?php doralashab_icon( 'arrow' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
