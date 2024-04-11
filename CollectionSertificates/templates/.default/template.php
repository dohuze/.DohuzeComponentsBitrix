<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

		<div class="job_listing_area">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6">
						<div class="section_title">
							<h3>Список сертификатов</h3>
						</div>
					</div>
					<?/*
						<div class="col-lg-6">
							<div class="brouse_job text-right">
								<a href="jobs.html" class="boxed-btn4">Browse More Job</a>
							</div>
						</div>
					*/?>
				</div>
				<?if ($arResult['UserId'] > 0):?>
				<div style="padding-top: 20px;">
					<label for="number">Номер сертификата:</label>
					<input type="text" id="number" name="number" placeholder="86AX-65PV">
					<a class="boxed-btn4" id="active" data-number="<?=$arResult['UserId']?>">Активировать</a>
				</div>
				<?else:?>
				<div style="padding-top: 20px;">
					<a href="/bitrix/">НЕОБХОДИМО АВТОРИЗОВАТЬСЯ</a>
				</div>
				<?endif?>
				<div class="job_lists">
					<div class="row">
						<?/* //////////////////////////////////////////////////////////////////////////////// */?>
						<div class="job_listing_area plus_padding">
							<div class="container">
								<div class="row">
									<?/*
										<div class="col-lg-3">
											<div class="job_filter white-bg">
												<div class="form_inner white-bg">
													<h3>Filter</h3>
													<form action="#">
														<div class="row">
															<div class="col-lg-12">
																<div class="single_field">
																	<input type="text" placeholder="Search keyword">
																</div>
															</div>
															<div class="col-lg-12">
																<div class="single_field">
																	<select class="wide">
																		<option data-display="Location">Location</option>
																		<option value="1">Rangpur</option>
																		<option value="2">Dhaka </option>
																	</select>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="single_field">
																	<select class="wide">
																		<option data-display="Category">Category</option>
																		<option value="1">Category 1</option>
																		<option value="2">Category 2 </option>
																	</select>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="single_field">
																	<select class="wide">
																		<option data-display="Experience">Experience</option>
																		<option value="1">Experience 1</option>
																		<option value="2">Experience 2 </option>
																	</select>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="single_field">
																	<select class="wide">
																		<option data-display="Job type">Job type</option>
																		<option value="1">full time 1</option>
																		<option value="2">part time 2 </option>
																	</select>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="single_field">
																	<select class="wide">
																		<option data-display="Qualification">Qualification</option>
																		<option value="1">Qualification 1</option>
																		<option value="2">Qualification 2</option>
																	</select>
																</div>
															</div>
															<div class="col-lg-12">
																<div class="single_field">
																	<select class="wide">
																		<option data-display="Gender">Gender</option>
																		<option value="1">male</option>
																		<option value="2">female</option>
																	</select>
																</div>
															</div>
														</div>
													</form>
												</div>
												<div class="range_wrap">
													<label for="amount">Price range:</label>
													<div id="slider-range"></div>
													<p>
														<input type="text" id="amount" readonly style="border:0; color:#7A838B; font-size: 14px; font-weight:400;">
													</p>
												</div>
												<div class="reset_btn">
													<button  class="boxed-btn3 w-100" type="submit">Reset</button>
												</div>
											</div>
										</div>
										*/?>
									<div class="col-lg-9">
										<?/*
											<div class="recent_joblist_wrap">
												<div class="recent_joblist white-bg ">
													<div class="row align-items-center">
														<div class="col-md-6">
															<h4>Job Listing</h4>
														</div>
														<div class="col-md-6">
															<div class="serch_cat d-flex justify-content-end">
																<select>
																	<option data-display="Most Recent">Most Recent</option>
																	<option value="1">Marketer</option>
																	<option value="2">Wordpress </option>
																	<option value="4">Designer</option>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											*/?>
										<div class="job_lists m-0">
											<?if ($arResult['UserId'] > 0):?>
											<div class="row">
												<?foreach ($arResult['dbItems'] as $value):?>
												<div class="col-lg-12 col-md-12">
													<div class="single_jobs white-bg d-flex justify-content-between">
														<div class="jobs_left d-flex align-items-center">
															<div class="thumb">
																<img src="<?=SITE_TEMPLATE_PATH?>/img/svg_icon/1.svg" alt="">
															</div>
															<div class="jobs_conetent">
																<a style="cursor: default; pointer-events: none;">
																Номер сертификата:<br>
																	<h4><?=$value['NAME']?></h4>
																</a>
																<div class="links_locat d-flex align-items-center">
																	<!--
																		<div class="location">
																			<p><i class="fa fa-map-marker"></i> California, USA</p>
																		</div>
																		<div class="location">
																			<p> <i class="fa fa-clock-o"></i> Part-time</p>
																		</div>
																	-->
																</div>
															</div>
														</div>
														<div class="jobs_right">
															<div class="apply_now">
																<?if ($value['is_activation'] == 'Y'):?>
																<a style="cursor: default; pointer-events: none;" class="heart_mark" id="heart_mark_<?=$value['NAME']?>"><i class="fa fa-heart"></i></a>
																<?else:?>
																<a style="cursor: default; pointer-events: none; visibility: hidden;" class="heart_mark" id="heart_mark_<?=$value['NAME']?>"><i class="fa fa-heart"></i></a>
																<?endif;?>
																
																<span class="boxed-btn3 activ" id="<?=$value['NAME']?>">Активировать</span>
																

																
																
															</div>
															<div class="date">
																<p id="date_<?=$value['NAME']?>"><?=$value['activations_date']?></p>
															</div>
														</div>
													</div>
												</div>
												<?endforeach?>
											</div>
											<?endif?>	
											<?/*
												<div class="row">
													<div class="col-lg-12">
														<div class="pagination_wrap">
															<ul>
																<li><a href="#"> <i class="ti-angle-left"></i> </a></li>
																<li><a href="#"><span>01</span></a></li>
																<li><a href="#"><span>02</span></a></li>
																<li><a href="#"> <i class="ti-angle-right"></i> </a></li>
															</ul>
														</div>
													</div>
												</div>
												*/?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?/* //////////////////////////////////////////////////////////////////////////////// */?>
					</div>
				</div>
			</div>
		</div>