<!DOCTYPE html>
<html lang="zxx">

<head>
	<link rel="stylesheet" href="css/room-details.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
	<?php include("header.php");
	$_SESSION['return_to'] = $_SERVER['REQUEST_URI']; ?>

	<!-- Breadcrumb Section Begin -->
	<div class="breadcrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumb-text">
						<h2>Room details</h2>
						<div class="bt-option">
							<a href="./index.php">Home</a>
							<a href="./rooms.php">Rooms</a>
							<span>Room details</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcrumb Section End -->

	<!-- Room Details Section Begin -->
	<section class="room-details-section spad">
		<div class="container">
			<div class="row">

				<?php
				include("connect.php");

				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$kq = mysqli_query($conn, "SELECT * FROM room WHERE id=$id");
					$row = mysqli_fetch_assoc($kq);
				}
				?>

				<div class="col-lg-8">
					<div class="room-details-item">
						<!-- <img src="../uploads/room/<?php echo $row['image'] ?>" alt="hình ảnh Phòng"> -->

						<div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img src="../uploads/room/<?php echo $row['image'] ?>" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="../uploads/room/<?php echo $row['image'] ?>" class="d-block w-100" alt="...">
								</div>
								<div class="carousel-item">
									<img src="../uploads/room/<?php echo $row['image'] ?>" class="d-block w-100" alt="...">
								</div>
							</div>
							<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
							</button>
						</div>
					</div>
				</div>

				<div class="col-lg-4 room-details-general">
					<div class="rd-text">
						<h3><?php echo $row['name'] ?></h3>
						<h2>$<?php echo $row['price'] ?><span>/Pernight</span></h2>
						<div class="rdt-right">
							<div class="rating" data-rating="<?php echo $row['star'] ?>">
							</div>
							<?php
							$kq5 = mysqli_query($conn, "SELECT count(id) as total FROM review WHERE idRoom=" . $id);
							$row5 = mysqli_fetch_assoc($kq5);
							$soDanhGia = $row5['total'];
							?>
							<p>(<?php echo $soDanhGia ?> reviews)</p>
						</div>
						<p class="f-para"><?php echo $row['detail'] ?></p>

					</div>
					<button id="showBookingForm" class="booking-btn">Booking Now</button>
					<!-- <a href="#" class="booking-btn">Booking Now</a> -->
					<a href="" class="add-to-cart-btn heart">
						<span><img src="img/icon/heart.png"></span>
						<p class="hover-text">wishlist</p>
					</a>
				</div>

			</div>
		</div>
	</section>

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Facilities</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p><?php echo $row['detail'] ?></p>
				</div>

				<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<h5>Size</h5>
									</td>
									<td>
										<h5><?php echo $row['size'] ?></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Bed</h5>
									</td>
									<td>
										<h5><?php echo $row['bed'] ?></h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Capacity</h5>
									</td>
									<td>
										<h5>
											<span><?php echo $row['adult'] ?> Adult</span>
											<span><?php $x = $row['children'];
													if ($x > 0) {
														echo ', ' . $x . ' Children';
													} ?> </span>
										</h5>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>

				<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-12">
							<div class="row total_rate">
								<div class="col-6">
									<div class="box_total">
										<h5>Overall</h5>
										<h4><?php
											if ($row['star'] % 1 !== 0) {
												echo $row['star'];
											} else {
												echo $row['star'] . ".0";
											}
											?></h4>
										<h6>(<?php echo $soDanhGia ?> reviews)</h6>
									</div>
								</div>
								<div class="col-6">
									<div class="rating_list">
										<h3>Based on <?php echo $soDanhGia ?> Reviews</h3>
										<ul class="list">
											<li><a href="#">5 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">4 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">3 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">2 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
											<li><a href="#">1 Star <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> 01</a></li>
										</ul>
									</div>
								</div>
							</div>


							<h4 class="fixed">Reviews</h4>
							<div class="rd-reviews" id="dsdanhgia">
								<?php
								date_default_timezone_set('Asia/Ho_Chi_Minh');

								$kq2 = mysqli_query($conn, "SELECT * FROM review WHERE idRoom=$id");
								if (isset($_SESSION['idUser'])) {
									$kq4 = mysqli_query($conn, "SELECT * FROM user WHERE id=" . $_SESSION['idUser']);
									$row4 = mysqli_fetch_assoc($kq4);
								}

								while ($row2 = mysqli_fetch_array($kq2)) {
									$kq3 = mysqli_query($conn, "SELECT * FROM user WHERE id=" . $row2['idUser']);
									$row3 = mysqli_fetch_assoc($kq3);
								?>
									<div class="review-item">
										<div class="ri-pic">
											<img src="../uploads/user/<?php echo $row3['Avatar'] ?>" alt="image User">
										</div>
										<div class="ri-text">
											<span><?php echo date("d-M-Y H:i:s", $row2['timePost']) ?></span>
											<div class="rating" data-rating="<?php echo $row2['star'] ?>"></div>
											<h5><?php echo $row3['Fullname'] ?></h5>
											<p><?php echo $row2['content'] ?></p>
										</div>
									</div>
								<?php
								}
								?>
							</div>
							<!-- <div class="review-add">
								<h4>Add Review</h4>
								<input type="hidden" id="id" value="<?php echo $_GET['id'] ?>">
								<div class="row">
									<div class="col-lg-12">
										<div>
											<h5>Your Rating:</h5>
											<div class="review-rating">
												<input type="checkbox" id="star1" name="rating" checked>
												<label for="star1"><i class="icon_star"></i></label>
												<input type="checkbox" id="star2" name="rating" checked>
												<label for="star2"><i class="icon_star"></i></label>
												<input type="checkbox" id="star3" name="rating" checked>
												<label for="star3"><i class="icon_star"></i></label>
												<input type="checkbox" id="star4" name="rating" checked>
												<label for="star4"><i class="icon_star"></i></label>
												<input type="checkbox" id="star5" name="rating" checked>
												<label for="star5"><i class="icon_star"></i></label>
											</div>

										</div>
										<textarea placeholder="Your Review" id="noidung"></textarea>
										<input type="submit" value="Submit" class="btn primary-btn" id="btnGui">
									</div>
								</div>
							</div> -->

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->
	<!-- Room Details Section End -->
	<div class="overlay" id="overlay"></div>
	<div id="bookingFormContainer" style="display: none;" class="col-lg-4">
		<div class="room-booking">
			<div class="canvas-close" style="float: right;">
				<i class="icon_close"></i>
			</div>
			<h3>Your Reservation</h3>
			<form action="form-booking.php" method="POST">
				<div class="check-date">
					<label for="date-in">Check In:</label>
					<input type="text" class="date-input" id="date-in" name="date-in">
					<i class="icon_calendar"></i>
				</div>
				<div class="check-date">
					<label for="date-out">Check Out:</label>
					<input type="text" class="date-input" id="date-out" name="date-out">
					<i class="icon_calendar"></i>
				</div>
				<div class="select-option">
					<label for="adults">Adults:</label>
					<select id="adults" name="adults">
						<option value="2">2</option>
					</select>
				</div>
				<div class="select-option">
					<label for="children">Children:</label>
					<select id="children" name="children">
						<option value="1">1</option>
					</select>
				</div>
				<div class="select-option">
					<label for="quantity">Quantity:</label>
					<select id="quantity">
						<option value="1">1</option>
					</select>
				</div>
				<button type="submit" class="book-btn">Booking</button>
			</form>
		</div>
	</div>


	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var checkboxes = document.querySelectorAll('.review-rating input[type="checkbox"]');
			checkboxes.forEach(function(checkbox) {
				checkbox.addEventListener('change', function() {
					var labels = document.querySelectorAll('.review-rating label');

					for (var i = 1; i <= 5; i++) {
						if (!checkboxes[i].checked) {
							labels[i].classList.remove('icon_star');
							labels[i].classList.add('icon_star_alt');
						} else {
							labels[i].classList.remove('icon_star_alt');
							labels[i].classList.add('icon_star');
						}
					}
				});
			});
		});

		$("#btnGui").click(function() {
			var selectedRating = $("input[name='rating']:checked").length;
			$.ajax({
				method: "POST",
				url: 'check-login.php',
				success: function(response) {
					if (response === 'loggedIn') {
						$.ajax({
								method: "POST",
								url: 'add-review.php',
								data: {
									id: $('#id').val(),
									star: selectedRating,
									noidung: $('#noidung').val()
								}
							})
							.done(function(data) {
								var newReview = `
                                    <div class="review-item">
                                        <div class="ri-pic">
                                            <img src="../uploads/user/<?php echo $row4['Avatar'] ?>" alt="image User">
                                        </div>
                                        <div class="ri-text">
                                            <span><?php echo date("d-M-Y H:i:s") ?></span>
                                            <div class="rating" data-rating="${selectedRating}">
                                            </div>
                                            <h5><?php echo $row4['Fullname'] ?></h5>
                                            <p>${$('#noidung').val()}</p>
                                        </div>
                                    </div>
                                `;

								$('#dsdanhgia').append(newReview);
								var ratingStars = '';
								for (var i = 0; i < selectedRating; i++) {
									ratingStars += '<i class="icon_star"></i>';
								}
								var emptyStars = 5 - selectedRating;
								for (var j = 0; j < emptyStars; j++) {
									ratingStars += '<i class="icon_star_alt"></i>';
								}
								$('#dsdanhgia .review-item:last .ri-text .rating').html(ratingStars);
								$('#noidung').val("");
								alert("Bạn vừa để lại một đánh giá.");
							})
							.fail(function(data) {
								console.log("Gửi không thành công");
							});
					} else {
						alert("Bạn chưa đăng nhập! Vui lòng đăng nhập để tiếp tục.");
						window.location.href = 'login.php';
					}
				},
				error: function() {
					console.log("Lỗi khi kiểm tra đăng nhập");
				}
			});
			console.log('Sending data:', {
				id: $('#id').val(),
				star: selectedRating,
				noidung: $('#noidung').val()
			});
		});



		$(document).ready(function() {
			$('#showBookingForm').click(function() {
				var roomId = <?php echo $id; ?>;
				$.ajax({
					url: 'check-login.php',
					type: 'GET',
					success: function(response) {
						if (response === 'loggedIn') {
							window.location.href = 'booking.php?id=' + roomId;
						} else {
							alert("Bạn chưa đăng nhập! Vui lòng đăng nhập để tiếp tục.");
							window.location.href = 'login.php';
						}
					},
					error: function() {}
				});
			});

		});
	</script>

	<?php mysqli_close($conn); ?>

	<?php include("footer.php") ?>

</body>

</html>