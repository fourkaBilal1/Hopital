<!DOCTYPE html>
<html>
<head>
	<title>Hospital DB</title>
	<meta charset="UTF-8" /> 
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Acme|Lobster" rel="stylesheet">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script>
		
		$(document).ready(function(){
			var status1 = $("#Q1");
			var status2 = $("#Q2");
			var status3 = $("#Q3");
			var status4 = $("#Q4");
			var status5 = $("#Q5");
			var status6 = $("#Q6");
			var status7 = $("#Q7");
			var status8 = $("#Q8");
			var status9 = $("#Q9");
			var status10 = $("#Q10");
			var status11 = $("#Q11");
			var status12 = $("#Q12");
			var status13 = $("#Q13");
			var status14 = $("#Q14");
			var status15 = $("#Q15");
			var status16 = $("#Q16");
			var status17 = $("#Q17");
			var status18 = $("#Q18");
			var status19 = $("#Q19");

			
			$.ajax({
	                type: 'post',
	                url: "./Answers/A1.php",
	                data: {
	                    'date' : $("#datepicker").val()
	                },
	                beforeSend: function(){
	                    status1.html("Connexion en cours...").fadeIn(400);
	                },
	                success: function(data){
	                    if(data == "err"){
	                        status1.html("Errors").fadeIn(400);
	                    } else {
	                        //data = JSON.parse(data)
	                        //alert('ajax completed. Response:  '+data);
	                    	status1.html(data).fadeIn(400);
	                    }
	                }
	            });
			$.ajax({
				type: 'get',
				url: "./Answers/A3.php",
				beforeSend: function(){
					status3.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status3.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status3.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A2.php",
				beforeSend: function(){
					status2.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status2.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status2.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A4.php",
				beforeSend: function(){
					status4.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status4.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status4.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A5.php",
				beforeSend: function(){
					status5.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status5.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status5.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A6.php",
				beforeSend: function(){
					status6.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status6.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status6.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A7.php",
				beforeSend: function(){
					status7.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status7.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status7.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A8.php",
				beforeSend: function(){
					status8.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status8.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status8.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A9.php",
				beforeSend: function(){
					status9.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status9.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status9.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A10.php",
				beforeSend: function(){
					status10.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status10.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status10.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A11.php",
				beforeSend: function(){
					status11.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status11.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status11.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A12.php",
				beforeSend: function(){
					status12.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status12.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status12.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A13.php",
				beforeSend: function(){
					status13.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status13.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status13.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A14.php",
				beforeSend: function(){
					status14.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status14.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status14.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A15.php",
				beforeSend: function(){
					status15.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status15.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status15.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A16.php",
				beforeSend: function(){
					status16.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status16.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status16.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A17.php",
				beforeSend: function(){
					status17.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status17.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status17.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A18.php",
				beforeSend: function(){
					status18.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status18.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status18.html(data).fadeIn(400);
                    }
                }
            });
            $.ajax({
				type: 'get',
				url: "./Answers/A19.php",
				beforeSend: function(){
					status19.html("Connexion en cours...").fadeIn(400);
				},
				success: function(data){
					if(data == "err"){
						status19.html("Errors").fadeIn(400);
					} else {
						//console.log("here");
						//console.log(data);
                        //alert('ajax completed. Response:  '+data);
                    	status19.html(data).fadeIn(400);
                    }
                }
            });
		});
		$('#datepicker').change(function(){

		});
	</script>
	<script>
	  	$( function() {
	    	$( "#datepicker" ).datepicker({
		    	onSelect: function(dateText) {
			        console.log("Selected date: " + dateText + "; input's current value: " + this.value);
			        var datepicker = $(this).val();
					var status1 = $("#Q1");
					$.ajax({
		                type: 'post',
		                url: "./Answers/A1.php",
		                data: {
		                    'date' : datepicker
		                },
		                beforeSend: function(){
		                    status1.html("Connexion en cours...").fadeIn(400);
		                },
		                success: function(data){
		                    if(data == "err"){
		                        status1.html("Errors").fadeIn(400);
		                    } else {
		                        //data = JSON.parse(data)
		                        //alert('ajax completed. Response:  '+data);
		                    	status1.html(data).fadeIn(400);
		                    }
		                }
		            });
		    	}
			});
			$('#datepicker').datepicker('setDate', new Date());
	  	});

		


	 	
	 	
	</script>
	<script>
		
		function process(){
			console.log("Selected %: " + $("#pourcentage") + "; input's current value: " + $("#pourcentage").val());
			var status12 = $("#Q12");
			$.ajax({
                type: 'post',
                url: "./Answers/A12.php",
                data: {
                    'Pr' : $("#pourcentage").val()
                },
                beforeSend: function(){
                    status12.html("Connexion en cours...").fadeIn(400);
                },
                success: function(data){
                    if(data == "err"){
                        status12.html("Errors").fadeIn(400);
                    } else {
                        //data = JSON.parse(data)
                        //alert('ajax completed. Response:  '+data);
                    	status12.html(data).fadeIn(400);
                    }
                }
            });
		}
		
	</script>
	<script>
		
		function process2(){
			//console.log("Selected %: " + $("#pourcentage") + "; input's current value: " + $("#pourcentage").val());
			var status16 = $("#Q16");
			$.ajax({
                type: 'post',
                url: "./Answers/A16.php",
                data: {
                    'yr' : $("#year").val()
                },
                beforeSend: function(){
                    status16.html("Connexion en cours...").fadeIn(400);
                },
                success: function(data){
                    if(data == "err"){
                        status16.html("Errors").fadeIn(400);
                    } else {
                        //data = JSON.parse(data)
                        //alert('ajax completed. Response:  '+data);
                    	status16.html(data).fadeIn(400);
                    }
                }
            });
		}
		
	</script>
</head>
<body>
	<h2 class="text-logo">Questions</h2>
	<div class="accordion" id="accordionExample" style="width: 70%; margin: auto; box-shadow: 0 0 10px black; border-radius: 10px;">
		<div class="card" style="border-radius: 10px;">
			<div class="card-header" id="headingOne">
				<h2 class="mb-0">
					<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						1) Quels sont les patients entrés à une date que l’on saisit ?
					</button>
					<span class="saisi" style="font-size: 0.6em;">Date: <input type="text"  id="datepicker"></span> 
				</h2>
			</div>

			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body" id="Q1">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingTwo">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						2) Quels sont les cancérologues qui sont chefs de service ?
					</button>
				</h2>
			</div>
			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
				<div class="card-body" id="Q2">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingThree">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						3) Quel est le nombre de lits dans chaque service ?
					</button>
				</h2>
			</div>
			<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
				<div class="card-body" id="Q3">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingFour">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
						4) Quel est le nombre de lits libres dans chaque salle du service de cardiologie au 04/07/2018 ?
						<!--SELECT A.NumSalle,A.Nblits-IFNull(B.CC, 0) as 'Lits libres au 04/07/2017'  FROM (SELECT * FROM HDB.SALLE where SALLE.NumServ in (SELECT SERVICE.NumService FROM HDB.SERVICE WHERE SERVICE.Nom = 'Cardiologie')) as A LEFT JOIN (SELECT NumSalle,COUNT(NumPat) as CC from hdb.hospitalisation WHERE DateEntree < '2018-07-04' and (DateSortie>'2018-07-04' or DateSortie = NULL ) GROUP BY NumSalle) as B on A.NumSalle = B.NumSalle -->
					</button>
				</h2>
			</div>
			<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
				<div class="card-body" id="Q4">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingFive">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
						5) Quels sont les patients qui n’ont jamais été traités par un cardiologue?
					</button>
				</h2>
			</div>
			<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
				<div class="card-body" id="Q5">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingSix">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
						6) Quels sont les patients qui ont subi au moins un acte dans tous les
						services ?
						<!--SELECT * FROM (SELECT DISTINCT acte.NumPat,service.NumService FROM Acte JOIN service ON acte.NumService = service.NumService) A GROUP BY A.NumPat HAVING count(*) = (SELECT COUNT(*) FROM service) -->
					</button>
				</h2>
			</div>
			<div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
				<div class="card-body" id="Q6">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingSeven">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"><?php
						echo wordwrap("7) Quels sont les médecins, leur spécialité et le nom du patient, qui ont
						traités un patient qui a subit un acte dans tous les services de l’hopital ? On triera le résultat par médecin.",140,"<br>\n",true)



					?>
						<!--SELECT hdb.medecin.Nom as 'Nom Medecin', hdb.medecin.Specialite,AA.Nom as 'Nom Patient',AA.Prenom  as 'Prenom Patient'  FROM (SELECT acte.NumMed,A.Nom,A.Prenom FROM acte JOIN (SELECT * FROM patient WHERE patient.NumPat in ( 
    SELECT A.NumPat FROM (SELECT DISTINCT hdb.acte.NumPat,service.NumService FROM hdb.Acte JOIN hdb.service ON acte.NumService = service.NumService) A GROUP BY A.NumPat HAVING count(*) = (SELECT COUNT(*) FROM hdb.service)
)) A on A.NumPat = hdb.acte.NumPat) AA JOIN hdb.medecin on medecin.NumMed = AA.NumMed ORDER BY medecin.Nom-->
					</button>
				</h2>
			</div>
			<div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
				<div class="card-body" id="Q7">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingEight">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
						8) Quel sont les patients qui sont toujours restés plus de deux semaines
						lors de leurs hospitalisations ?
					</button>
				</h2>
			</div>
			<div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
				<div class="card-body" id="Q8">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingNine">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
						9) Quels sont les patients qui ont toujours été traités sans être hospitalisés ?
					</button>
				</h2>
			</div>
			<div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
				<div class="card-body" id="Q9">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingTen">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
						10) Quels sont les services qui n’ont traités que des patients non hospitalisés ?
					</button>
				</h2>
			</div>
			<div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
				<div class="card-body" id="Q10">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingEleven">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
						11) Quels sont les patients et le service, des patients qui n’ont eu un acte
						que dans un seul service ?
					</button>
				</h2>
			</div>
			<div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordionExample">
				<div class="card-body" id="Q11">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingTwelve">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
						12) Quelles sont les services dont la majorité des patients ont été hospitalisés au moins 2 jours ?
					</button>
					<br>
					<span class="pr" style="font-size: 0.4em;margin-left: 40px;"> % de la majorite entre 0 et 100: <input type="text"  id="pourcentage" value="80" onkeyup="process()"></span>
				</h2>
			</div>
			<div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordionExample">
				<div class="card-body" id="Q12">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingThirteen">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
						13) Quels sont les patients hospitalisés plus de trois jours qui ne sont pas
						à la mutelle MUT.
					</button>
				</h2>
			</div>
			<div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordionExample">
				<div class="card-body" id="Q13">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingFourteen">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
						14) Quel est le nombre moyen de patients (différents) par médecin (patient
						ayant subit un acte par le médecin) ?
					</button>
				</h2>
			</div>
			<div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-parent="#accordionExample">
				<div class="card-body" id="Q14">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingFifteen">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
						15) Quelle est la moyenne des actes par jour pour l’ensemble des medecins ?
					</button>
				</h2>
			</div>
			<div id="collapseFifteen" class="collapse" aria-labelledby="headingFifteen" data-parent="#accordionExample">
				<div class="card-body" id="Q15">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingSixteen">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">
						16) Quel est le medecin qui a traité le plus de patients dans une année que l'on saisit ? 
					</button>
					<br>
					<span class="yr" style="font-size: 0.4em;margin-left: 40px;"> Annee: <input type="text"  id="year" value="2019" onkeyup="process2()"></span>
					<!--
					SELECT acte.NumMed,COUNT(*) Cnt FROM acte WHERE EXTRACT(YEAR FROM acte.DateActe)=2019 GROUP BY acte.NumMed HAVING COUNT(*)=(SELECT MAX(mycount) 
FROM (SELECT NumMed,COUNT(NumMed) mycount 
FROM acte WHERE EXTRACT(YEAR FROM acte.DateActe)=2019 
GROUP BY NumMed) A)
					-->
				</h2>
			</div>
			<div id="collapseSixteen" class="collapse" aria-labelledby="headingSixteen" data-parent="#accordionExample">
				<div class="card-body" id="Q16">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingSeventeen">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapseSeventeen">
						17) quels sont les services qui n'ont traité que des patients qui ont la mutuelle ?
						<!--
							SELECT * FROM service WHERE NumService in (SELECT DISTINCT NumService FROM acte WHERE NumPat in (SELECT NumPat FROM patient WHERE patient.Mutuelle ='MUT') and NumService not in (SELECT NumService FROM acte WHERE NumPat in (SELECT NumPat FROM patient WHERE patient.Mutuelle !='MUT')))
						-->
					</button>
				</h2>
			</div>
			<div id="collapseSeventeen" class="collapse" aria-labelledby="headingSeventeen" data-parent="#accordionExample">
				<div class="card-body" id="Q17">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingEighteen">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEighteen" aria-expanded="false" aria-controls="collapseEighteen">
						18) quelles sont les specialités qui ont le nombre minimum de medecins?
						<!--
							SELECT * from (SELECT Specialite,COUNT(*) cnt FROM `medecin` GROUP BY Specialite HAVING COUNT(*)=(SELECT MIN(cnt) MinC FROM (SELECT Specialite,COUNT(*) cnt FROM `medecin` GROUP BY Specialite) A)) B 
						-->
					</button>
				</h2>
			</div>
			<div id="collapseEighteen" class="collapse" aria-labelledby="headingEighteen" data-parent="#accordionExample">
				<div class="card-body" id="Q18">
					Connexion en cours...
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header" id="headingNineteen">
				<h2 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNineteen" aria-expanded="false" aria-controls="collapseNineteen">
						19) Quelles sont les salles qui ont été utilisées dans les dernières 31 jours? Et quelles sont leurs services correspondents ?
						<!--
							SELECT * FROM service JOIN 
							(SELECT * FROM 
							salle 
							JOIN 
							(SELECT NumSalle NMSL,hospitalisation.NumService FROM hospitalisation WHERE CURDATE()-DateEntree <= 31) A 
							on 
							salle.NumServ=A.NumService and salle.NumSalle=A.NMSL) B
							on 
							service.NumService = B.NumService
						-->
					</button>
				</h2>
			</div>
			<div id="collapseNineteen" class="collapse" aria-labelledby="headingNineteen" data-parent="#accordionExample">
				<div class="card-body" id="Q19">
					Connexion en cours...
				</div>
			</div>
		</div>
		</br>
	</div>


</body>
</html>




