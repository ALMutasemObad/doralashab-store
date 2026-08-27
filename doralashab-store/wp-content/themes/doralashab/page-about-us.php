<?php
get_header();

$values = array(
	array( 'quality', 'الجودة والإتقان', 'عناية بالمحتوى والمنتج النهائي في كل مرحلة.' ),
	array( 'document', 'الالتزام والتوثيق', 'وضوح في النطاق والمخرجات ومتابعة منظمة للتنفيذ.' ),
	array( 'book', 'العناية بالمحتوى', 'احترام الفكرة والمؤلف والقارئ، وصناعة كتاب يليق بهم.' ),
	array( 'target', 'التطوير المستمر', 'حلول مرنة تتطور مع احتياج سوق المعرفة والمؤسسات.' ),
);
?>

<section class="da-inner-hero da-inner-hero--paper" aria-labelledby="about-title">
	<div class="da-container da-inner-hero-layout">
		<div data-reveal>
			<p class="da-kicker">عن شركة دور الأصحاب</p>
			<h1 id="about-title"><span>شركة سعودية صنعت مسيرتها</span><span>حول المعرفة</span></h1>
			<p>نعمل في صناعة الكتاب وتوريده، ونقدم حلول المكتبات للقطاعات التعليمية والثقافية والحكومية ضمن مسار مؤسسي واضح.</p>
		</div>
		<div class="da-about-year" data-reveal><span>بداية المسيرة</span><strong>1423 هـ</strong><small>خبرة تتجاوز 23 عاماً</small></div>
	</div>
</section>

<section class="da-section da-section--white">
	<div class="da-container da-story-grid">
		<div class="da-story-heading" data-reveal><p class="da-kicker">قصتنا</p><h2>من دار للنشر والتوزيع<br>إلى منظومة تخدم المؤسسة</h2></div>
		<div class="da-story-copy" data-reveal>
			<p class="da-lead">بدأت دور الأصحاب من إيمان واضح بأن الكتاب الجيد لا تنتهي رحلته عند الطباعة؛ بل تكتمل حين يصل إلى قارئه، وحين تجد المؤسسة المعرفة التي تناسب مستفيديها.</p>
			<p>ومع تراكم الخبرة، امتد عمل الشركة من النشر والإنتاج المعرفي إلى توزيع وتوريد الكتب، وتنمية مجموعات المكتبات، والتجهيز الفني، وإدارة المشاريع المعرفية بحسب نطاق كل مشروع.</p>
			<p>اليوم تجمع الشركة بين الحس الثقافي والانضباط التنفيذي؛ لتقدّم للكاتب والقارئ والجهة مساراً متماسكاً من الفكرة إلى التسليم.</p>
		</div>
	</div>
</section>

<section class="da-section da-direction-section">
	<div class="da-container">
		<div class="da-direction-grid">
			<article class="da-direction-card da-direction-card--green" data-reveal><span><?php doralashab_icon( 'target' ); ?></span><p class="da-kicker da-kicker--light">رؤيتنا</p><h2>شريك موثوق في صناعة ونشر المعرفة</h2><p>أن تكون دور الأصحاب حضوراً مؤثراً لدى القارئ والمؤسسة، وأن تربط جودة المحتوى بجودة التنفيذ والوصول.</p></article>
			<article class="da-direction-card" data-reveal><span><?php doralashab_icon( 'document' ); ?></span><p class="da-kicker">رسالتنا</p><h2>محتوى رصين ومخرجات واضحة</h2><p>إنتاج محتوى رصين، ودعم المؤلف، وتقديم حلول نشر ومكتبات تنتهي بمخرجات قابلة للمراجعة والاستلام.</p></article>
		</div>
		<div class="da-values-grid">
			<?php foreach ( $values as $value ) : ?><article data-reveal><span><?php doralashab_icon( $value[0] ); ?></span><h3><?php echo esc_html( $value[1] ); ?></h3><p><?php echo esc_html( $value[2] ); ?></p></article><?php endforeach; ?>
		</div>
	</div>
</section>

<section class="da-founder-profile" id="founder" aria-labelledby="founder-page-title">
	<div class="da-founder-profile-image" aria-hidden="true"></div>
	<div class="da-container da-founder-profile-inner">
		<div class="da-founder-profile-copy" data-reveal>
			<p class="da-kicker da-kicker--light">المؤسس</p>
			<h2 id="founder-page-title">الأستاذ عبدالرحمن<br>بن سعد العوين</h2>
			<p class="da-founder-role">رؤية إدارية تشكلت في سوق الكتاب والمعرفة</p>
			<p>يقود المؤسس مسيرة تتجاوز 23 عاماً في سوق النشر والتوزيع، مع تركيز على صناعة الكتاب، وبناء قنوات وصوله، وفهم احتياجات المؤسسات التعليمية والثقافية والمكتبات.</p>
			<p>وتقوم رؤيته على أن المعرفة مشروع متكامل: محتوى يعتنى به، وكتاب ينتج بإتقان، وتوريد ينفذ بانضباط، ومكتبة تصبح أكثر قدرة على خدمة مستفيديها.</p>
			<blockquote>«نصنع للمعرفة مكاناً يليق بها، ونقرّبها من قارئها ومؤسستها.»</blockquote>
		</div>
	</div>
</section>

<section class="da-section da-saudi-vision-section">
	<div class="da-container da-saudi-vision-grid">
		<div data-reveal><p class="da-kicker">هوية سعودية</p><h2>معرفة تنمو مع طموح المملكة</h2><p>تنطلق دور الأصحاب من المملكة العربية السعودية، وتسهم عبر النشر والتوزيع وحلول المكتبات في تعزيز الوصول إلى المعرفة وخدمة القطاعات التعليمية والثقافية.</p></div>
		<?php if ( file_exists( get_template_directory() . '/assets/images/vision-2030.png' ) ) : ?><div class="da-vision-mark" data-reveal><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/vision-2030.png' ); ?>" alt="رؤية السعودية 2030"><span>لمسة وطنية تعبّر عن الاتجاه والطموح</span></div><?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
