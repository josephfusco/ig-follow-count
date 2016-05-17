<?php

require_once('startup.php');
require_once('database.php');
get_header();


?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h4><p class="text-info">Search for a user:</p></h4>

            <div class="input-group">
                <span class="input-group-btn">
          <button type="button" value="submit" class="btn btn-primary" onclick="ajax()" id="get_id" name="submit">Submit</button>
        </span>
                <input type="text" id="username" name="username" value="fitness" class="form-control">
            </div>

            <div id="result" class="row">
                <div class="avatar col-md-6 col-md-push-3"></div>
                <div class="users_name col-md-3"></div>
                <div class="followers col-md-3"></div>
                <div class="user_id col-md-3"></div>
            </div>

        </div>
        <div class="col-md-6 resultsCol">

            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Comments</th>
                        <th>Likes</th>
                    </tr>
                </thead>
            </table>

            <table id="sum_table" class="table table-bordered">
                <tr class="totalColumn success">
                    <td class="totalComment"></td>
                    <td class="totalLikes"></td>
                    <td class="engagementRatio"></td>
                </tr>
            </table>
						<button type="button" id="sendToDb" class="btn btn-primary" onclick="updateDatabase()">Update Database</button>
        </div>
    </div>
</div>

<!-- Modal Start here-->
<div class="modal fade bs-example-modal-sm" id="myPleaseWait" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
										<span class="glyphicon glyphicon-time">
										</span>Please Wait
								 </h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-info
										progress-bar-striped active" style="width: 100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal ends Here -->


<!-- Begin DB query table -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<?php include 'includes/historydisplay.php'; ?>
		</div>
	</div>
</div>
<!-- End DB query Table -->



<script type="text/javascript">
	//Hide the Results table and results thumbnail on load
	$(document).ready(function () {
			$(".resultsCol").addClass("hidden");
			$("#result").addClass("hidden");
	});

	function ajax() {
			//Displays a loading screen modal for 1000 ms
			//Displays an alert if the Engagement Ratio isn't calculated in time
			$('#myPleaseWait').modal('show');
			$.ajax({
					url: "recent.php",
					success: setTimeout(function (data) {
							$('#myPleaseWait').modal('hide');
					}, 1000),
					error: setTimeout(function (data) {
							if ($(".engagementRatio").text().split(": ").pop() === "NaN") {
									$('#myPleaseWait').modal('hide');
									alert("Engagement Ratio Not Loaded Please Reload Page");
							}
					}, 1000)
			})
			// First Ajax, Gets the profile pic, the user id #, and the username
			var username = document.getElementById("username").value;
			var usernameToken = "access_token=<?php echo IG_ACCESS_TOKEN; ?>";
			$.ajax({
					type: "GET",
					dataType: "jsonp",
					username: username,
					cache: false,
					url: "https://api.instagram.com/v1/users/search?q=" + username + "&" + usernameToken,
					success: function (data) {
							for (var i = 0; i < data.data.length; i++) {
									if (this.username == data.data[i].username) {
											// Display the User's ID
											$("#result .user_id").append("User ID: " + data.data[i].id + "<br />");
											// Display your profile pic so you know with certainty that this is the profile you searched for
											var avatar = "<a href='https://www.instagram.com/" + data.data[i].username + "' target='_blank'><img src='" + data.data[i].profile_picture + "' alt='username " + data.data[i].username + "' ></a>";
											$("#result .avatar").append(avatar);
											// Display the username
											var username = "Username: " + "<a href='https://www.instagram.com/" + data.data[i].username + "' target='_blank'>" + data.data[i].username + "</a><br />";
											$("#result .users_name").append(username);
											// Second request
											// Adds the Likes + Comments data to the rows
											$.ajax({
													type: "GET",
													dataType: "jsonp",
													url: "https://api.instagram.com/v1/users/" + data.data[i].id + "/media/recent/?" + usernameToken,
													success: function (data) {
															var tr;
															for (var i = 0; i < 9; i++) {
																	tr = $('<tr/>');
																	tr.append('<td class="comment_count">' + '<span class="number">' + data.data[i].comments.count + '</span>' + '</td>');
																	tr.append('<td class="likes_count">' + '<span class="number">' + data.data[i].likes.count + '</span>' + '</td>');
																	$('#myTable').append(tr);
															}
													}
											});
											// Third request
											// Adds the followers count
											$.ajax({
													type: "GET",
													dataType: "jsonp",
													url: "https://api.instagram.com/v1/users/" + data.data[i].id + "/?" + usernameToken,
													success: function (data) {
															// Add the # of followers
															var followers = "# of Followers: <span class='number'>" + data.data.counts.followed_by + "</span><br />";
															$("#result .followers").append(followers);
													}
											});
											//Fourth Ajax-- displays user history table Below
											//For the fucking life of me I cannot figure out how to send this data to historydisplay.php
											//Therefore historydisplay.php will only work if the username is hard coded into the file
											$.ajax({
												type: "POST",
												url: "includes/historydisplay.php",
												data: username,
												cache: false,
												success: function(data){
													username = $("#username").val();
													console.log("THE USERNAME I HAVE IS:::::: " + username);
												}
											});

									}
							}
					}
			});
			// This is where I add up all the numbers in the Comments and Likes columns
			// setTimeout for a delay in processing. Helps Ajax not mess up. Very hacky fix, not for production
			setTimeout(function () {
					var sumComments = 0;
					// Get comment count numbers
					$(".comment_count").each(function () {
							var value = $(this).text();
							// Add only if the value is number
							if (!isNaN(value) && value.length != 0) {
									sumComments += parseFloat(value);
							}
					});
					var totLikes = 0;
					// Get likes count numbers
					$(".likes_count").each(function () {
							var value_likes = $(this).text();
							if (!isNaN(value_likes) && value_likes.length != 0) {
									totLikes += parseFloat(value_likes);
							}
					});
					//Add <span class='number'> to results for number formatting
					$('.totalComment').html("Total Comments: <b><span class='number total_comments'>" + sumComments + "</span></b>" + "<p>Average Comments: <b><span class='number avg_comments'>" + parseInt(sumComments / 9) + "</span></b></p>");
					//Below takes the total number of likes and displays that number, then on the next line it divides the number by 9 and displays the average likes
					$('.totalLikes').html("Total Likes: <b><span class='number total_likes'>" + totLikes + "</span></b>" + "<p>Average Likes: <b><span class='number avg_likes'>" + parseInt(totLikes / 9) + "</span></b></p>");
					// Add in the math for the engagement Ratio
					// [Likes + Comments] / Followers = Engagement Rate
					// I only sample the first 9 images on their account. No sense in getting numbers for pics that are 6 months old
					var likesAndComments = totLikes + sumComments;
					var numOfFollowers = $(".followers").text().split(": ").pop();
					var engagementRatio = likesAndComments / numOfFollowers * 100;
					$(".engagementRatio").html("Engagement Ratio: " + "<b>" + engagementRatio.toFixed(2) + "</b>");
					//Activate the jQuery Number plugin to add commas on thousands
					$('span.number').number(true);
					//Display the table with results
					$(".resultsCol").toggleClass("hidden");
					//Display the results thumbnail
					$("#result").toggleClass("hidden");
					//disable the submit button to prevent double feeding of results
					$('#get_id').prop('disabled', true);
			}, 1000);
	}

	//UPDATE DATABASE FUNCTION --- NOT WORKING
	//http://stackoverflow.com/questions/24315471/how-to-save-data-using-ajax-and-pdo
	function updateDatabase(){
		event.preventDefault();
		//Define data var
		var data = {};
		//Finds the DOM element, splits, pops and replaces any commas, kinda ghetto but YOLO
		data.num_followers = $(".followers").text().split(": ").pop().replace(/,/g, "");
		data.user_id = $(".user_id").text().split(": ").pop();
		data.users_name = $(".users_name").text().split(": ").pop();
		data.total_comments = $(".total_comments").text().replace(/,/g, "");
		data.avg_comments = $(".avg_comments").text().replace(/,/g, "");
		data.total_likes = $(".total_likes").text().replace(/,/g,"");
		data.avg_likes = $(".avg_likes").text().replace(/,/g,"");
		data.engagement_ratio = $(".engagementRatio").text().split(": ").pop();
		data.picture = $(".avatar a").html();

		$.ajax({
			type: "POST",
			url: "includes/update.php",
			data: data,
			cache: false,
			success: function(response){
				console.log("# of Followers: " + data.num_followers);
				console.log("User ID: " + data.user_id);
				console.log("User Name: " + data.users_name);
				console.log("Total Comments: " + data.total_comments);
				console.log("Average Comments: " + data.avg_comments);
				console.log("Total Likes: " + data.total_likes);
				console.log("Average Likes: " + data.avg_likes);
				console.log("Engagement Ratio: " + data.engagement_ratio);
				console.log("Picture: " + data.picture);
			},
			error: function (xhr, ajaxOptions, thrownError) {
           console.log(xhr.status);
           console.log(xhr.responseText);
           console.log(thrownError);
       }
		});
		//Disable button on click
		$('#sendToDb').prop('disabled', true);
	};



</script>

<?php get_footer(); ?>
