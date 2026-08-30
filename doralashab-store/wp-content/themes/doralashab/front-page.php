<?php
get_header();

$shop_url = home_url( '/shop/' );
$latest   = array();

if ( class_exists( 'WooCommerce' ) ) {
	$shop_url = wc_get_page_permalink( 'shop' );
	$latest   = wc_get_products(
		array(
			'status'  => 'publish',
			'limit'   => 12,
			'orderby' => 'date',
			'order'   => 'DESC',
		)
	);
	$latest = array_values(
		array_filter(
			$latest,
			static fn( $item ) => 0 !== strpos( (string) $item->get_sku(), 'ND-2026-' )
		)
	);
	$latest = array_slice( $latest, 0, 8 );
}

$campaign_products = array(
	array( 'ND-2026-BAG', 'حقيبة هِمّة المدرسية', 'حقيبة يومية', 'national-day-backpack.jpg', 149, 99, 'خصم 34٪', 'خفيفة، مبطنة، ومصممة ليوم دراسي أكثر ترتيباً.' ),
	array( 'ND-2026-PENS', 'طقم أقلام وطن', '12 قطعة', 'national-day-pens.jpg', 45, 29, 'خصم 36٪', 'أقلام حبر ورصاص مختارة للكتابة والرسم اليومي.' ),
	array( 'ND-2026-COLORS', 'صندوق ألوان الإبداع', '36 لوناً', 'national-day-colors.jpg', 59, 39, 'خصم 34٪', 'ألوان غنية وسهلة الاستخدام للمشاريع والواجبات الفنية.' ),
	array( 'ND-2026-KIT', 'باقة قرطاسيتك كاملة', '16 قطعة', 'national-day-stationery.jpg', 119, 79, 'خصم 34٪', 'دفاتر ومقلمة وأدوات تنظيم أساسية في باقة واحدة.' ),
);
$student_bundle_id  = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'ND-2026-BUNDLE-STUDENT' ) : 0;
$siblings_bundle_id = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( 'ND-2026-BUNDLE-SIBLINGS' ) : 0;
$student_bundle     = $student_bundle_id ? wc_get_product( $student_bundle_id ) : false;
$siblings_bundle    = $siblings_bundle_id ? wc_get_product( $siblings_bundle_id ) : false;

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

<section class="da-national-hero" aria-labelledby="home-hero-title">
	<span class="da-national-hero-pattern" aria-hidden="true"></span>
	<div class="da-container da-national-hero-grid">
		<div class="da-national-hero-copy" data-reveal>
			<p class="da-national-brandline">شركة دور الأصحاب للنشر والتوزيع</p>
			<p class="da-national-eyebrow"><span>عروض اليوم الوطني</span><b>93</b></p>
			<h1 id="home-hero-title"><span>هِمّة</span> تتعلّم</h1>
			<p class="da-national-lead">نحتفل بوطنٍ يعلو بالعلم، ونجهّز أبناءه لبداية مدرسية تليق بطموحهم.</p>
			<div class="da-national-benefits" aria-label="مزايا العرض">
				<span><?php doralashab_icon( 'quality' ); ?> خصومات حتى 36٪</span>
				<span><?php doralashab_icon( 'boxes' ); ?> باقات جاهزة للمدرسة</span>
			</div>
			<div class="da-hero-actions">
				<a class="da-button da-button--gold" href="#national-day-products">تسوّق المجموعة <?php doralashab_icon( 'arrow' ); ?></a>
				<a class="da-button da-button--glass" href="#national-day-offers">شاهد الباقات</a>
			</div>
			<div class="da-countdown-wrap" data-campaign-countdown data-target="2026-09-23T23:59:59+03:00" aria-label="الوقت المتبقي لنهاية عروض اليوم الوطني">
				<p>العرض ينتهي خلال</p>
				<div class="da-countdown" aria-live="polite">
					<span><strong data-days>00</strong><small>يوم</small></span>
					<i>:</i>
					<span><strong data-hours>00</strong><small>ساعة</small></span>
					<i>:</i>
					<span><strong data-minutes>00</strong><small>دقيقة</small></span>
					<i>:</i>
					<span><strong data-seconds>00</strong><small>ثانية</small></span>
				</div>
			</div>
		</div>
		<div class="da-national-hero-visual" data-reveal>
			<div class="da-national-image-frame">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/national-day-campaign.jpg' ); ?>" alt="مجموعة همة تتعلم من الحقائب والأقلام والألوان والقرطاسيات" width="1600" height="900" fetchpriority="high">
				<span class="da-floating-discount"><b>حتى</b><strong>36٪</strong><small>خصم</small></span>
			</div>
			<div class="da-national-proof"><span><?php doralashab_icon( 'school' ); ?></span><p><small>من البيت إلى المدرسة</small><strong>كل ما يحتاجه الطالب في مكان واحد</strong></p></div>
		</div>
	</div>
	<div class="da-national-marquee" aria-label="رسالة الحملة">
		<div><span>همة تتعلّم</span><i>✦</i><span>أسعار وطنية</span><i>✦</i><span>اختيارات مدرسية أذكى</span><i>✦</i><span>نشر وتوزيع وحلول معرفية سعودية</span></div>
	</div>
</section>

<section class="da-section da-national-products" id="national-day-products" aria-labelledby="national-products-title">
	<div class="da-container">
		<div class="da-national-section-heading" data-reveal>
			<div><p class="da-kicker">مجموعة العام الدراسي</p><h2 id="national-products-title">اختيارات صغيرة،<br><span>لطموحاتٍ كبيرة.</span></h2></div>
			<div><p>منتجات مدرسية عملية بهوية وطنية أنيقة، وأسعار صممت لتجعل العودة إلى المدرسة أسهل.</p><a class="da-text-link" href="<?php echo esc_url( $shop_url ); ?>">استكشف المتجر كاملاً <?php doralashab_icon( 'arrow' ); ?></a></div>
		</div>
		<div class="da-campaign-product-grid">
			<?php foreach ( $campaign_products as $index => $campaign_product ) : ?>
				<?php
				$product_id = function_exists( 'wc_get_product_id_by_sku' ) ? wc_get_product_id_by_sku( $campaign_product[0] ) : 0;
				$product    = $product_id ? wc_get_product( $product_id ) : false;
				?>
				<article class="da-campaign-product" data-reveal>
					<a class="da-campaign-product-media" href="<?php echo esc_url( $product ? $product->get_permalink() : $shop_url ); ?>">
						<span class="da-campaign-badge"><?php echo esc_html( $campaign_product[6] ); ?></span>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $campaign_product[3] ); ?>" alt="<?php echo esc_attr( $campaign_product[1] ); ?>" width="900" height="900" loading="lazy">
					</a>
					<div class="da-campaign-product-body">
						<span class="da-campaign-product-meta"><?php echo esc_html( $campaign_product[2] ); ?></span>
						<h3><a href="<?php echo esc_url( $product ? $product->get_permalink() : $shop_url ); ?>"><?php echo esc_html( $campaign_product[1] ); ?></a></h3>
						<p><?php echo esc_html( $campaign_product[7] ); ?></p>
						<div class="da-campaign-product-footer">
							<div class="da-campaign-price"><del><?php echo esc_html( $campaign_product[4] ); ?> ر.س</del><strong><?php echo esc_html( $campaign_product[5] ); ?> <small>ر.س</small></strong></div>
							<?php if ( $product && $product->is_purchasable() && $product->is_in_stock() ) : ?>
								<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" data-quantity="1" data-product_id="<?php echo esc_attr( $product_id ); ?>" class="da-campaign-add add_to_cart_button ajax_add_to_cart" rel="nofollow" aria-label="أضف <?php echo esc_attr( $campaign_product[1] ); ?> إلى السلة"><?php doralashab_icon( 'cart' ); ?><span>أضف</span></a>
							<?php else : ?>
								<a class="da-campaign-add" href="<?php echo esc_url( $shop_url ); ?>" aria-label="تسوق <?php echo esc_attr( $campaign_product[1] ); ?>"><?php doralashab_icon( 'arrow' ); ?><span>تسوّق</span></a>
							<?php endif; ?>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="da-section da-national-offers" id="national-day-offers" aria-labelledby="national-offers-title">
	<div class="da-container">
		<div class="da-national-offers-intro" data-reveal>
			<p class="da-kicker da-kicker--light">وفّر أكثر مع الباقات</p>
			<h2 id="national-offers-title">عرضٌ لكل بداية</h2>
			<p>من طالبٍ واحد إلى فصلٍ كامل، جهّز احتياجك بسعر واضح وخيارات قابلة للتوسع.</p>
		</div>
		<div class="da-offer-cards">
			<article class="da-offer-card" data-reveal>
				<span class="da-offer-label">الأكثر طلباً</span>
				<p class="da-offer-kicker">باقة الطالب</p>
				<h3>بداية كاملة</h3>
				<p>حقيبة هِمّة + باقة القرطاسية + صندوق الألوان</p>
				<div class="da-offer-price"><del>327 ر.س</del><strong>199 <small>ر.س</small></strong></div>
				<span class="da-offer-saving">وفّر 128 ر.س</span>
				<?php if ( $student_bundle ) : ?>
					<a class="da-button add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="<?php echo esc_attr( $student_bundle_id ); ?>" href="<?php echo esc_url( $student_bundle->add_to_cart_url() ); ?>">أضف الباقة للسلة <?php doralashab_icon( 'cart' ); ?></a>
				<?php else : ?>
					<a class="da-button" href="#national-day-products">تسوّق مكونات الباقة <?php doralashab_icon( 'arrow' ); ?></a>
				<?php endif; ?>
			</article>
			<article class="da-offer-card da-offer-card--featured" data-reveal>
				<span class="da-offer-label">قيمة مضاعفة</span>
				<p class="da-offer-kicker">باقة الأشقاء</p>
				<h3>هِمّتان في بيت واحد</h3>
				<p>حقيبتان + باقتا قرطاسية + مجموعتا أقلام</p>
				<div class="da-offer-price"><del>626 ر.س</del><strong>349 <small>ر.س</small></strong></div>
				<span class="da-offer-saving">وفّر 277 ر.س</span>
				<?php if ( $siblings_bundle ) : ?>
					<a class="da-button da-button--gold add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="<?php echo esc_attr( $siblings_bundle_id ); ?>" href="<?php echo esc_url( $siblings_bundle->add_to_cart_url() ); ?>">أضف باقة الأشقاء <?php doralashab_icon( 'cart' ); ?></a>
				<?php else : ?>
					<a class="da-button da-button--gold" href="#national-day-products">تسوّق مكونات الباقة <?php doralashab_icon( 'arrow' ); ?></a>
				<?php endif; ?>
			</article>
			<article class="da-offer-card da-offer-card--schools" data-reveal>
				<span class="da-offer-label">للمدارس</span>
				<p class="da-offer-kicker">تجهيز الفصول</p>
				<h3>30 طالباً، طلب واحد</h3>
				<p>تجهيز مرن للحقائب والقرطاسيات مع خدمة توريد للجهات.</p>
				<div class="da-offer-price"><span>يبدأ من</span><strong>4,990 <small>ر.س</small></strong></div>
				<span class="da-offer-saving">عرض سعر خلال يوم عمل</span>
				<a class="da-button da-button--light" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">اطلب عرض المدرسة <?php doralashab_icon( 'arrow' ); ?></a>
			</article>
		</div>
		<p class="da-offer-note" data-reveal>* تسري العروض حتى نهاية 23 سبتمبر 2026 أو حتى نفاد الكمية. الأسعار تشمل ضريبة القيمة المضافة.</p>
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
