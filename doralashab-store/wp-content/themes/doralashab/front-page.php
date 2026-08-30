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
	array( '01', 'نفهم الاحتياج', 'أهداف الجهة وطبيعة المستفيدين وسياق المشروع.' ),
	array( '02', 'نحدد النطاق', 'الأعمال والمخرجات والمسؤوليات ومعايير القبول.' ),
	array( '03', 'نبني الخطة', 'مسار التنفيذ والتوريد والمراجعة والاعتماد.' ),
	array( '04', 'ننفذ ونراجع', 'تنفيذ منظم والتحقق من المطابقة وجودة المخرجات.' ),
	array( '05', 'نوثق التقدم', 'كشوف وملاحظات وقرارات تحفظ وضوح المشروع.' ),
	array( '06', 'نسلم ونتابع', 'فحص واستلام وتوصيات تدعم التشغيل والمتابعة.' ),
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

<section class="da-profile-hero" aria-labelledby="home-hero-title">
	<span class="da-profile-hero-lines da-profile-hero-lines--top" aria-hidden="true"></span>
	<span class="da-profile-hero-lines da-profile-hero-lines--bottom" aria-hidden="true"></span>
	<div class="da-container da-profile-hero-inner" data-reveal>
		<?php if ( file_exists( get_template_directory() . '/assets/images/logo.png' ) ) : ?>
			<img class="da-profile-hero-logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="شركة دور الأصحاب للنشر والتوزيع" width="435" height="184">
		<?php endif; ?>
		<p class="da-profile-kicker">شركة سعودية في خدمة المعرفة</p>
		<h1 id="home-hero-title"><span>نشر وتوزيع وحلول</span><span>مؤسسية للمعرفة</span></h1>
		<p class="da-profile-hero-copy"><span>خبرة سعودية تجمع صناعة المحتوى وتوريد المصادر،</span><span>وتطوير المكتبات ضمن مسار مؤسسي واضح وموثوق.</span></p>
		<div class="da-hero-actions">
			<a class="da-button" href="<?php echo esc_url( $shop_url ); ?>">تصفح الكتب <?php doralashab_icon( 'arrow' ); ?></a>
			<a class="da-button da-button--quiet" href="<?php echo esc_url( home_url( '/library-services/' ) ); ?>">حلول الجهات والمكتبات</a>
		</div>
		<ul class="da-hero-sectors" aria-label="القطاعات التي تخدمها الشركة">
			<?php foreach ( $sectors as $sector ) : ?>
				<li><span><?php doralashab_icon( $sector[0] ); ?></span><strong><?php echo esc_html( $sector[1] ); ?></strong></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="da-saudi-band">
		<div class="da-container">
			<div class="da-saudi-band-copy"><span>جذور سعودية</span><strong>نخدم المعرفة بما يواكب طموح المملكة</strong></div>
			<?php if ( file_exists( get_template_directory() . '/assets/images/vision-2030.png' ) ) : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/vision-2030.png' ); ?>" alt="رؤية السعودية 2030" loading="eager">
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="da-section da-snapshot-section" id="about">
	<div class="da-container da-snapshot-grid">
		<div class="da-snapshot-copy" data-reveal>
			<p class="da-kicker">الشركة في لمحة</p>
			<h2>مسيرة سعودية<br><span>في خدمة المعرفة</span></h2>
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
			<p class="da-kicker">القطاعات التي نخدمها</p>
			<h2 id="sectors-title">حلول تتكيّف مع طبيعة كل جهة</h2>
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
			<div><p class="da-kicker da-kicker--light">منظومة مترابطة</p><h2 id="services-title"><span>تخدم الكتاب،</span><span>وتفهم المؤسسة.</span></h2></div>
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
				<div><p class="da-kicker">مختارات من المتجر</p><h2 id="books-title">إصدارات لقارئ يبحث عن قيمة</h2></div>
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
			<div><p class="da-kicker">منهج عمل واضح</p><h2 id="method-title" class="da-balanced-title"><span>من الاحتياج إلى التسليم…</span><span>بلا مناطق رمادية</span></h2></div>
			<p>منهج مرحلي يوضح الأعمال والمخرجات والمسؤوليات، ويجعل الفحص والاستلام جزءاً من التنفيذ.</p>
		</div>
		<div class="da-method-grid" data-reveal>
			<?php foreach ( $workflow as $step ) : ?>
				<article><span><?php echo esc_html( $step[0] ); ?></span><h3><?php echo esc_html( $step[1] ); ?></h3><p><?php echo esc_html( $step[2] ); ?></p></article>
			<?php endforeach; ?>
		</div>
		<div class="da-deliverables" data-reveal>
			<div class="da-deliverables-copy"><p class="da-kicker da-kicker--light">مخرجات قابلة للمراجعة والاستلام</p><h3>ما الذي تستلمه الجهة؟</h3><p>تتحدد المخرجات بحسب طبيعة المشروع ونطاقه، وقد تشمل:</p></div>
			<div class="da-deliverables-grid">
				<?php foreach ( $deliverables as $item ) : ?><span><?php doralashab_icon( $item[0] ); ?><strong><?php echo esc_html( $item[1] ); ?></strong></span><?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section class="da-section da-presence-section" id="institutional-presence" aria-labelledby="presence-title">
	<div class="da-container">
		<div class="da-section-heading da-section-heading--center" data-reveal>
			<p class="da-kicker">حضور مؤسسي ومعرفي</p>
			<h2 id="presence-title">محطات في التعليم والثقافة والجودة</h2>
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
			<div><p class="da-kicker da-kicker--light">حضور معرفي ممتد</p><h3>مشاركة في معارض الكتاب الدولية</h3><p>حضور يعزز وصول الإصدارات، ويوسع قنوات التوزيع والتواصل مع الناشرين والقراء.</p></div>
		</div>
	</div>
</section>

<section class="da-founder-preview" aria-labelledby="founder-title">
	<div class="da-founder-image" aria-hidden="true"></div>
	<div class="da-container da-founder-preview-inner">
		<div class="da-founder-copy" data-reveal>
			<p class="da-kicker da-kicker--light">المؤسس</p>
			<h2 id="founder-title">خبرة تقود<br>رؤية الدار</h2>
			<p>يقود الأستاذ عبدالرحمن بن سعد العوين مسيرة تتجاوز 23 عاماً في سوق النشر والتوزيع، مع تركيز على صناعة الكتاب ووصوله إلى القارئ والمؤسسة.</p>
			<p>وترتكز رؤيته على فهم احتياجات قطاع المعرفة في المملكة، وربط جودة المحتوى بانضباط التنفيذ واستدامة الأثر.</p>
			<a class="da-button da-button--light" href="<?php echo esc_url( home_url( '/about-us/#founder' ) ); ?>">تعرّف إلى مسيرة المؤسس <?php doralashab_icon( 'arrow' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
