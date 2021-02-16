<?php
/** autor Cristina Gutierrez **/
/** date 08-05-2019 **/
/** MMV PREPROD **/
  $dispositivo = 0;
  $detecttablet = 0;
  include('Mobile_Detect.php');
  $detect = new Version_Mobile();
  if( $detect->isMobile() && !$detect->isTablet()  ){
    $dispositivo=1;
	}else{
    $dispositivo=0;
  } 
  if( $detect->isTablet()){
	$detecttablet=1;
  }
  if( $detect->isMobile()){
	$detecttablet=2;
  }
  if (!isset($_COOKIE['mobile'])) {

	setcookie("mobile", $dispositivo, time()+3600);  /* expira en una hora */
  }
   if (isset($_COOKIE['mobile']) AND $_COOKIE['mobile']!=$dispositivo) {
   	setcookie("mobile", $dispositivo, time()+3600);  /* expira en una hora */
  }  
  $input = JFactory::getApplication()->input;
  $itemid = $input->getInt('Itemid');
  switch ($this->language){
  	case 'fr-FR' :
  	$lang = 'fr';
  	break;
  	case 'en-gb' :
  	$lang = 'en';
  	break;
  	case 'ca-es' :
  	$lang = 'partenaires';
  	break;
  	case 'bs-BA' :
  	$lang = 'cgos';
  	break;
  	case 'fr-ca' :
  	$lang = 'macif';
	break;
	case 'ca-es' :
	$lang = 'partenaires';
	break;
	case 'ca-ES' :
	$lang = 'partenaires';
	break;
  	default:
  	$lang = 'fr';
  	break;
  }

	$app = JFactory::getApplication();
	$menu = $app->getMenu();
	$active = $menu->getActive();
	$itemId = $active->id;
	$title = $active->title;
	 
	$fichacamping =  $active->menutype;
	$alias =  $active->alias;
	$typemenu = $active->query['view'];
	$description = $active->params->get('menu-meta_description');
    $title = $active->params->get('page_title');

    $langue = JFactory::getLanguage();

    if($typemenu == 'camping'): $classbody = 'etablessiment '; elseif($typemenu == 'campings'): $classbody = 'etablessiments '; else: $classbody = $typemenu; endif; 
    if($typemenu == 'tipopromotion' || $typemenu == 'tipopromotions' || $typemenu == 'cms'): $classbody = 'tipopromotion cms'; endif; 
    if($lang == 'partenaires' AND $typemenu == 'campings'): $classbody = ' etablessiments tipopromotion cms '; endif; 
    /*$module = JModuleHelper::getModule('mod_campings');
	$params = new JRegistry($module->params);
	print_r($params);*/
	switch ($typemenu) {
		case 'camping':
			$imageslide = getImageOg('etablissements' , $alias);
			break;
		
		default:
			$imageslide = 'https://'.$_SERVER['HTTP_HOST'].'/images/logo.png';
			break;
	}
	function getImageOg($directori , $alias){

		$imgRut = 'images/'.$directori.'/'.$alias.'/slide';
		$imgPath = 'https://'.$_SERVER['HTTP_HOST'].'/images/'.$directori.'/'.$alias.'/slide';
		if (file_exists($imgRut)) :

			$ficheros  = scandir($imgRut);
					foreach ($ficheros as $key => $value)
											{
						if( preg_match("/\.(png|gif|jpe?g|bmp)/",$value,$m)) {
							$images[] = $value; 
														

						}
													  
					}  
												
			$imageslide = $imgPath.'/'.$value;
		else:
			$imageslide = 'https://'.$_SERVER['HTTP_HOST'].'/images/logo.png';
		endif;

		return $imageslide;
	}
?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<link rel="alternate" href="https://www.mmv.fr/" hreflang="fr-FR" /> 
<link rel="alternate" href="https://www.mmv-holidays.co.uk" hreflang="en-GB" /> 
<link rel="alternate" href="https://www.mmv-holidays.co.uk/nl" hreflang="nl-NL" /> 
<link rel="alternate" href="https://www.mmv.fr/" hreflang="x-default" />
<jdoc:include type="head" />
<meta name="viewport" content="width=device-width">
<?php $this->setGenerator(null); ?>
<link rel="apple-touch-icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/apple-touch-icon.png" /> 
 <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/style.css?vers=1"  type="text/css" /> 
<!-- <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/style.min.css"  type="text/css" />  -->
<!-- <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/styletest.css"  type="text/css" />  -->
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/bulma.css"  type="text/css" /> 
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/line-awesome-font-awesome.min.css"  type="text/css" />  -->
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/line-awesome.min.css"  type="text/css" /> 
<?php if($dispositivo == 0){ ?>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/responsive.css"  type="text/css" />
<?php } ?>
<link rel="canonical" href="<?php echo 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
<!-- Open Graph data -->
<meta property="og:url"                content="<?php echo 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="<?php echo $title; ?>" />
<meta property="og:description"        content="<?php echo $description; ?>" />
<meta property="og:image"              content="<?php echo $imageslide; ?>" />
<!-- Twitter Card data -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@mmv_Club">
<meta name="twitter:title" content="<?php echo $title; ?>">
<meta name="twitter:description" content="<?php echo $description; ?>">
<meta name="twitter:creator" content="@mmv_Club">
<meta name="twitter:image" content="<?php echo $imageslide; ?>">
<meta name="theme-color" content="#1b438e" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/nouislider.min.css"  type="text/css" />
<?php if($dispositivo==1){?>
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/mobile.css"  type="text/css" /> 
<?php } ?>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css"  type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css"  type="text/css" />
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/1.12.1jquery-ui.min.js" type="text/javascript"></script><!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/bootstrap.min.css">
<script  src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/bootstrap.min.js"></script>
<!-- jQuery library -->

<?php if($typemenu !='landingpage'): ?>
	<!-- <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/script.js"></script> 
	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/buscador.js"></script>  -->
<?php endif; ?>

<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/script.js"></script> 

<!-- LEAFLET LIBRARY -->

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"  integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/MarkerCluster.css">
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/MarkerCluster.Default.css">
<script  src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/leaflet.markercluster.js"></script> 
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/mapClass.js"></script>
<!-- LEAFLET LIBRARY -->
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/ajax.js"></script> 
<!-- SLICK SLIDE CAMPING-->
	<!-- Add the slick-theme.css if you want default styling -->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
	<!-- Add the slick-theme.css if you want default styling -->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>	

	<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
	<!-- <link href="https://mreq.github.io/slick-lightbox/dist/slick-lightbox.css" rel="stylesheet" type="text/css" />
	<script src="https://mreq.github.io/slick-lightbox/dist/slick-lightbox.js"> type="text/javascript"></script> -->
	<link href="https://vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/4.12/video.js"></script>
<!-- SLICK SLIDE CAMPING-->
<!-- Date Range Picker Library-->
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/moment.min.js"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<!-- lightgallery / lightSlide-->             
	<!-- <link type="text/css" rel="stylesheet" href="//sachinchoolur.github.io/lightslider/dist/css/lightslider.min.css" />                  -->
	<link type="text/css" rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/lightslider.min.css" />                 
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.12/css/lightgallery.min.css" />                 
	<!-- <link type="text/css" rel="stylesheet" href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.min.css" />                  
	<script type="text/javascript" src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.min.js"></script> -->

	<!-- <script type="text/javascript" src="//sachinchoolur.github.io/lightslider/dist/js/lightslider.min.js"></script> -->
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/lightslider.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.12/js/lightgallery-all.min.js"></script>
<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5M292KK');</script>
<!-- End Google Tag Manager -->




</head>
<?php 

/********************** LOGIN PARTENAIRE POR LANDINGPAGE Y CODE POR GET ***********/
/*******EJ:  ( http://partenaires.mmv.fr/premiere-minute-montagne-hiver?login_partenaire=COMP048107)  ***********/


if(isset($_GET["login_partenaire"]) AND $itemId !=3204 ):
	if (!isset($_COOKIE['partner_code']) AND $_COOKIE['partner_code']=='') :
		$uri = & JFactory::getURI();
		$absolute_url = $uri->toString(); 
		$url = parse_url($absolute_url);
		$url = 'https://'.$url['host'].'/partenaires'.$url['path']; //https://sitenew.preprod.mmv.resalys.com/vacances-a-la-mer
		echo '<input type="hidden" id="partner_code" value="'.$_GET["login_partenaire"].'" />';
		echo '<input type="hidden" id="mermontagne" value="1" />';
		echo '<input type="hidden" id="urlPartenaire" value="'.$url.'" />';
		echo '<script type="text/javascript">callAuthPartenaire();</script>';
	endif;
endif;


/*************************************************************************/
/********************** LOGIN PARTENAIRE *******************************/
/**************************** MMV ***************************************/

if($lang == 'partenaires' AND $itemId !=3204):
	
		if (!isset($_COOKIE['partner_code']) AND $_COOKIE['partner_code']=='' AND !isset($_GET["login_partenaire"])) :
			header("Location: https://sitenew.preprod.mmv.resalys.com/partenaires/loginp");
		endif;


endif;




/*************************************************************************/
/********************** MAQUETACÓN WEB PC *******************************/
/**************************** MMV ***************************************/

if($dispositivo == 0): ?>
	<body id="page<?php echo $itemId; ?>" class="<?php echo $classbody; ?>" >
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5M292KK"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->


		<?php if ($this->countModules('saison') ) : ?><jdoc:include type="modules" name="saison" /><?php endif; ?>
		<?php if ($this->countModules('cgosbienvenue')) : ?><div class="offrebasheader headercgos"><div class="container text-center blanctext"><jdoc:include type="modules" name="cgosbienvenue"  /></div></div><?php endif; ?>
		<?php if ($this->countModules('partenairebienvenue')) : ?><div class="offrebasheader headerpartenaire"><div class="container text-center blanctext"><jdoc:include type="modules" name="partenairebienvenue"  /></div></div><?php endif; ?>
		<?php if ($this->countModules('offretop')) : ?><div class="bluebackground offrebasheader"><div class="container text-center blanctext"><jdoc:include type="modules" name="offretop"  /></div></div><?php endif; ?>
			<div class="contheaderprinc"><header class=" <?php if($typemenu =='camping'): ?> headerpageetab <?php else: ?> container <?php endif; ?>">
				<!-- <div class="row"> -->
					<?php if ($this->countModules('menu')) : ?><div class="menuprinccont"><jdoc:include type="modules" name="menu"  /><jdoc:include type="modules" name="recherchermenu"  /><?php endif; ?></div>
					
				<!-- </div> -->
			</header></div>

			<!-- bloque rechercher home -->

			<?php if ($this->countModules('rechercher') ) : ?>
					
				<aside  class="bluedbackground" >

					<div id="contentrechercherslide" class="bluedbackground">
						<div class="row">
							<div class="col-12  col-lg-7" ></div>
							<div class="col-12  col-lg-5" >
							<?php if ($itemId == 101) : ?>
											<div class="" id="slidehome">
												<img src="" alt="Vacances mmv" title="Vacances mmv" width="100%" height="auto" />
											</div>
							<?php endif; ?>
							</div >
						</div>	
					</div>
				</aside>

				<!-- rechercher home -->

							<aside id="rechercherslide" >
								<div class="container" >
									<div class="row">
									<div class="col-12  <?php if($itemid==101 OR $typemenu =='campings'): echo 'col-lg-7'; endif; ?>" >
										<div class="row">
											<div class="col-12" >
											<div id="logotop" ><jdoc:include type="modules" name="logo" /></div><?php if($typemenu !='camping'): ?>	<jdoc:include type="modules" name="menusites" /></div><?php endif; ?>	
											<?php if($typemenu !='camping' AND $typemenu !='campings'): ?><?php if ($this->countModules('rechercher')) : ?>
												<div id="rechercher" class="col-12 " ><jdoc:include type="modules" name="rechercher" /></div>
											<?php endif; ?><?php endif; ?>
										</div>

									</div>

									<div class="col-12 col-lg-5" >
										<div class="row">
											<div class="col-12" >
												<?php if($lang == 'fr' || $lang == 'en' ): ?>
												<jdoc:include type="modules" name="top" /><jdoc:include type="modules" name="lang" />
												<?php endif;  ?>
											</div>
									</div>
								</div>
								<div class="container">
									<?php if($typemenu =='campings'): 

										if($itemId==2355):
										echo'<div class="row">';
										echo'<di class="col-12 bg-white blocrassure" >';
										echo '<div  class="row text-center bluetext  pl-2 my-3">';
											echo'	<div class="col-3  pl-0  "> <h6 class="py-4"><img class="pr-2" src="https://www.mmv.fr/images/icones/icons8-change-euro-30.png"><span class="pt-2">Séjour garanti ou remboursé​</span></h6></div>';
												echo'<div class="col-3"> <h6 class="py-4"><img src="https://www.mmv.fr/images/icones/icons8-garantie-30_3.png">Garantie Meilleur Prix</h6></div>';
												echo' <div class="col-3 "> <h6 class="py-4"><img class="pr-2" src="https://www.mmv.fr/images/icones/icons8-carte-en-cours-dutilisation-30_1.png">Paiement en 2 fois</h6></div>';
											echo'	 <div class="col-3  px-0"> <h6 class="py-4"><img class="pr-2" src="https://www.mmv.fr/images/icones/icons8-lire-un-message-30.png"><span class="">Paiement ANCV</span> 
											 </div> </div> </di> </div>';
												 
												
										endif; 
										if ($this->countModules('rechercher')) : ?>
													<div id="rechercher" ><jdoc:include type="modules" name="rechercher" /></div>
													
										<?php endif; ?>
										
									<?php endif; ?>
								</div>
							</aside>

				<!-- rechercher home -->	        
	        <?php endif; ?>
			<!-- bloque rechercher home -->
			<?php if($this->countModules('header')) : ?>
				<aside id="header" class="bluedbackground contentheaderslide">
							<div class="container" >
									<div class="row">
									<div class="col-6" >
										<div class="row">
											<div class="col-12" >
											<div id="logotop" ><jdoc:include type="modules" name="logo" /></div><jdoc:include type="modules" name="menusites" /></div>
											
										</div>

									</div>

									<div class="col-6" >
										<div class="row">
											<div class="col-12" >
												<?php if($lang == 'fr' || $lang == 'en' ): ?>
												<jdoc:include type="modules" name="top" /><jdoc:include type="modules" name="lang" />
												<?php endif; ?>
											</div>

											
									</div>
								</div>
							
							<jdoc:include type="modules" name="header" />
				</aside>
			<?php endif; ?>

			
			<?php if ($this->countModules('clubs') AND $itemId!=2402) : ?>
				<aside id="clubs" >

					<jdoc:include type="modules" name="clubs" />
				</aside>
			<?php endif; ?>
			<?php if ($this->countModules('carte')) : ?>
				<aside id="carte" class="bluebackground">
					<div class="container"><jdoc:include type="modules" name="carte" /></div>
				</aside>
			<?php endif; ?>
			

			
			<?php if ($this->countModules('espritclub')) : ?>
				<div class="container titleespritclubs "><div class="row"><h2 class="col"><?Php echo JText::_('COM_CONTENT_ESPRIT_CLUB'); ?></h2><a class="blueexdbackground blanctext d-flex p-3 align-items-center bothomexpe" href="l-experience-mmv" /><?Php echo JText::_('COM_CONTENT_PROLONGUEZ'); ?></a></div></div>

				<aside id="espritclub" class="container">
					<jdoc:include type="modules" name="espritclub" />
				</aside>
			<?php endif; ?>
			<?php if ($this->countModules('promotions')) : ?>
				<aside id="promotions" class="container">
					<jdoc:include type="modules" name="promotions" />
				</aside>
			<?php endif; ?>
			<?php if ($this->countModules('devenezpartenaire')) : ?>

				<!-- cuando estemos en partenaire pagina authentificacion cargaremos el form para darsede alta -->
				<div id="devendezpatenaire" ><div class="formnewslmodal container"><jdoc:include type="modules" name="devenezpartenaire" /><p onclick="AddOpen('#devendezpatenaire .formnewslmodal ');">X</p></div></div>

			<?php endif; ?>
			<?php if ($this->countModules('codeoblie')) : ?>

				<!-- cuando estemos en partenaire pagina authentificacion cargaremos el form para darsede alta -->
				<div id="codeoblie" ><div class="formnewslmodal container"><jdoc:include type="modules" name="codeoblie" /><p onclick="AddOpen('#codeoblie .formnewslmodal ');">X</p></div></div>

			<?php endif; ?>
			
			<?php if($typemenu !='camping'): ?>
					<?php if ($this->countModules('left')) : ?>
						<div class="container"><div class="row">
							<div class="col-12 col-lg-4 greycbackground rechercherfilter"><jdoc:include type="modules" name="left" /></div>
							<div class="col-12 col-lg-8"><section><article class="container"><jdoc:include type="component" />
								<?php if ($this->countModules('article')) : ?>
									<jdoc:include type="modules" name="article" />
								<?php endif; ?>
							</article></section></div>
						</div></div>
						<!-- <section><article class="container"><jdoc:include type="component" /></article></section> -->
					<?php else : ?>
						<jdoc:include type="component" />
					<?php endif ; ?>
			<?php else: ?>
					<jdoc:include type="component" />	
			<?php endif; ?>
			<?php if ($this->countModules('vosgaranties')) : ?>
				<aside id="vosgaranties" >
					<jdoc:include type="modules" name="vosgaranties" />
				</aside>
			<?php endif; ?>
			<?php if ($this->countModules('clubs') AND $itemId==2402) : ?>
				<div class="titleclubsmmv d-flex align-items-center container bluedtext">
			  				<h2 class="float-left "><strong>  20 Clubs  </strong><span class="mmvfont"> mmv</span> <br></h2><span class=" ">Lequel sera votre préféré ?</span>

			  	</div>
				<aside id="clubs" class="m-0">
					<jdoc:include type="modules" name="clubs" />
				</aside>
			<?php endif; ?>
			<footer id="backgroundfooter">
				<?php if ($this->countModules('ressurence')) : ?>
					<aside id="ressurence" class="container">
						<jdoc:include type="modules" name="ressurence" />
					</aside>
				<?php endif; ?>
				<?php if ($this->countModules('submenu')) : ?>
					<aside id="submenu" class="container blancbackground">
						<jdoc:include type="modules" name="submenu" />
					</aside>
				<?php endif; ?>
				<?php if ($this->countModules('avisfooter')) : ?>
					<aside id="avisfooter" class="container blancbackground">
						<jdoc:include type="modules" name="avisfooter" />
					</aside>
				<?php endif; ?>
				<?php if ($this->countModules('newsletter')) : ?>
					<aside id="newsletter" class="container blancbackground">
						<jdoc:include type="modules" name="newsletter" />
					</aside>
				<?php endif; ?>
			    <aside id="linksfooter" class="container blancbackground">
						<div class="row">
						<?php if ($this->countModules('shared')) : ?>
								<div class="col-12 col-md-10"><jdoc:include type="modules" name="shared" /></div>
					    <?php endif; ?>
						<?php if ($this->countModules('lang')) : ?>
								<?php if($lang == 'fr' || $lang == 'en' ): ?>
								<div class="col-12 col-md-2"><jdoc:include type="modules" name="langbas" /></div>
								<?php endif; ?>
					    <?php endif; ?>
						</div>
				</aside>
				<aside id="textfooter" class="container blancbackground">
						<?php if ($this->countModules('textfooter')) : ?>
								<div><jdoc:include type="modules" name="textfooter" /></div>
					    <?php endif; ?>
					    
				</aside>
				<?php if ($this->countModules('footer')) : ?>
					<aside id="textfooter" class="container blancbackground">
						<jdoc:include type="modules" name="footer" />
					</aside>
				<?php endif; ?>
				<?php if ($this->countModules('menufooter')) : ?>
					<aside id="menufooter" class="container blancbackground">
						<jdoc:include type="modules" name="menufooter" />
					</aside>
				<?php endif; ?>
				
			</footer>

<?php endif; 

/*************************************************************************/
/********************** MAQUETACÓN WEB MOBILE *******************************/
/**************************** MMV ***************************************/

if($dispositivo == 1): ?>

	<body id="page<?php echo $itemId; ?>" class="webmobile <?php echo $classbody; ?>" >

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5M292KK"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->


		<?php if ($this->countModules('saison') ) : ?><jdoc:include type="modules" name="saison" /><?php endif; ?>
		<?php if ($this->countModules('cgosbienvenue')) : ?><div class="offrebasheader headercgos"><div class="container text-center blanctext"><jdoc:include type="modules" name="cgosbienvenue"  /></div></div><?php endif; ?>
		<?php if ($this->countModules('partenairebienvenue')) : ?><div class="offrebasheader headerpartenaire"><div class="container text-center blanctext"><jdoc:include type="modules" name="partenairebienvenue"  /></div></div><?php endif; ?>
			
			<header class=" <?php if($typemenu =='camping'): ?> headerpageetab <?php endif; ?>">
				<!-- <div class="row"> -->
					<?php if ($this->countModules('menu')) : ?>
						<div class="menuprinccont"><jdoc:include type="modules" name="menu"  /><jdoc:include type="modules" name="recherchermenu"  /><?php endif; ?></div>
						<?php if ($this->countModules('header') ) : ?><aside id="header" class="bluedbackground contentheaderslide"><jdoc:include type="modules" name="header" /><?php endif; ?></aside>
				<!-- </div> -->
			</header>
			<!-- bloque rechercher home -->

			<?php if ($this->countModules('rechercher') ) : ?>
			
				<aside  class="bluedbackground" >

					<div id="contentrechercherslide" class="bluedbackground">
						
							<?php if ($itemId == 101) : ?>
											<div class="" id="slidehome">
												<img src="" alt="Vacances mmv" title="Vacances mmv" width="100%" height="auto" />
											</div>
							<?php endif; ?>
					</div>
				</aside>
				<!-- rechercher home -->
							<aside id="rechercherslide" >
								<div class="container" >
										<div class="row">
											<!-- <div class="col-12" >
												<div id="logotop" ><jdoc:include type="modules" name="logo" />
											</div> -->
											<?php if($typemenu !='camping' AND $typemenu !='campings'): ?><?php if ($this->countModules('rechercher')) : ?>
											<div id="rechercher" class="col-12 " >

												<jdoc:include type="modules" name="rechercher" /></div>
											<?php endif; ?><?php endif; ?>
								</div>
								<div class="container">
									<?php if($typemenu =='campings'): ?>

										<?php if ($this->countModules('rechercher')) : ?>

													<div id="rechercher" >
												<?php
												echo '<div class="bluedbackground contentheaderslide contentheaderslidebottom ">';
												echo '<button class="closfiltersmobile blancbackground bluetext text-center p-2 rounded-3" >'.JText::_('Affiner').'</button>';
												echo '<button class="closrecherchersmobile  blanctext text-center p-2 rounded-3" ><i class="fas fa-search"></i>'.JText::_('Modifier').'</button></div>'; ?>
												<div class="recherchermobile"><jdoc:include type="modules" name="rechercher" /></div></div>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</aside>

				<!-- rechercher home -->
	        <?php endif; ?>
			<!-- bloque rechercher home -->
			<?php if ($this->countModules('clubs') AND $itemId!=2402) : ?>
				<aside id="clubs" >

					<jdoc:include type="modules" name="clubs" />
				</aside>
			<?php endif; ?>
			<?php if ($this->countModules('carte')) : ?>
				<aside id="carte" class="bluebackground">
					<div class="container"><jdoc:include type="modules" name="carte" /></div>
				</aside>
			<?php endif; ?>
			
			
			<?php if ($this->countModules('promotions')) : ?>
				<aside id="promotions" class="container">
					<jdoc:include type="modules" name="promotions" />
				</aside>
			<?php endif; ?>
			<?php if ($this->countModules('espritclub')) : ?>
				<div class="container titleespritclubs text-center"><h2><strong>L'esprit Club</strong> mmv<br/>une montagne d'émotions !</h2></div>
				<aside id="espritclub" class="container">
					<jdoc:include type="modules" name="espritclub" />
				</aside>
			<?php endif; ?>

			<?php if ($this->countModules('brochuremobile')) : ?>
				<aside id="brochuremobile" class="container">
					<jdoc:include type="modules" name="brochuremobile" />
				</aside>
			<?php endif; ?>
			<?php if($typemenu !='camping'): ?>
					<?php if ($this->countModules('left')) : ?>
						<?php if($typemenu =='campings'): ?>
						<div class="container resultsmobilecontainer"><div class="row">
						<?php else: ?>
						<div class="container"><div class="row">
						<?php endif; ?>

						<div class="container"><div class="row">
							<div class="col-12 col-lg-4 greycbackground rechercherfilter"><jdoc:include type="modules" name="left" /></div>
							<?php if($typemenu =='campings'): ?>
								<div class="col-12 col-lg-8 resulsbusquedamobile"><section><article class="container"><jdoc:include type="component" />
							<?php else: ?>
								<div class="col-12 col-lg-8"><section><article class="container"><jdoc:include type="component" />
							<?php endif; ?>

							<!-- <div class="col-12 col-lg-8"><section><article class="container"><jdoc:include type="component" /> -->
								<?php if ($this->countModules('article')) : ?>
									<jdoc:include type="modules" name="article" />
								<?php endif; ?>
							</article></section></div>
						</div></div>
						<!-- <section><article class="container"><jdoc:include type="component" /></article></section> -->
					<?php else : ?>
						<div class=""><jdoc:include type="component" /></div>
					<?php endif ; ?>
			<?php else: ?>
					<jdoc:include type="component" />
					
			<?php endif; ?>
			<?php if ($this->countModules('vosgaranties')) : ?>
				<aside id="vosgaranties" >

					<jdoc:include type="modules" name="vosgaranties" />
				</aside>
			<?php endif; ?>
	        <?php if ($this->countModules('clubs') AND $itemId==2402) : ?>
				<aside id="clubs" >
					<jdoc:include type="modules" name="clubs" />
				</aside>
			<?php endif; ?>
			<footer id="backgroundfooter">
				<?php if ($this->countModules('ressurence')) : ?>
					<aside id="ressurence" class="container">
						<jdoc:include type="modules" name="ressurence" />
					</aside>
				<?php endif; ?>
				<?php if ($this->countModules('submenu')) : ?>
					<aside id="submenu" class="container blancbackground">
						<jdoc:include type="modules" name="submenu" />
					</aside>
				<?php endif; ?>
				<?php if ($this->countModules('avisfooter')) : ?>
					<aside id="avisfooter" class="container blancbackground">
						<jdoc:include type="modules" name="avisfooter" />
					</aside>
				<?php endif; ?>
				<?php if ($this->countModules('newsletter')) : ?>
					<aside id="newsletter" class="container blancbackground">
						<jdoc:include type="modules" name="newsletter" />
					</aside>
				<?php endif; ?>
			    <aside id="linksfooter" class="container blancbackground">
						<div class="row">
						<?php if ($this->countModules('shared')) : ?>
								<div class="col-12 col-lg-9"><jdoc:include type="modules" name="shared" /></div>
					    <?php endif; ?>
					    <?php if ($this->countModules('lang')) : ?>
								<div class="col-12 col-lg-3"><jdoc:include type="modules" name="langbas" /></div>
					    <?php endif; ?>
						</div>
				</aside>
				<aside id="textfooter" class="container blancbackground">
						<?php if ($this->countModules('textfooter')) : ?>
								<div><jdoc:include type="modules" name="textfooter" /></div>
					    <?php endif; ?>
					    
				</aside>
				<?php if ($this->countModules('footer')) : ?>
					<aside id="textfooter" class="container blancbackground">
						<jdoc:include type="modules" name="footer" />
					</aside>
				<?php endif; ?>
				<?php if ($this->countModules('menufooter')) : ?>
					<aside id="menufooter" class="container blancbackground">
						<jdoc:include type="modules" name="menufooter" />
					</aside>
				<?php endif; ?>
				
			</footer>

<?php endif; ?>
<!-- <style>
.contheaderprinc.visible{
	background-color: #fff;
    position: relative;
    z-index: 10;
}
</style> -->
<!-- <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>  -->
<!-- fin script jgallery -->
<script src="<?php echo $this->baseurl ?>/libraries/awesomplete-gh-pages/awesomplete_custom.min.js"></script>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/lightgallery.css">
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/lightgallery.min.js"></script>
 <!-- lightgallery plugins -->
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/lg-thumbnail.min.js"></script>
<!-- <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/lg-fullscreen.min.js"></script> -->
</body>
</html>