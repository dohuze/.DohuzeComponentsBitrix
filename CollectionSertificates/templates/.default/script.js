document.addEventListener("DOMContentLoaded", () => {
	document.getElementById("active").addEventListener("click", function() {
		let number = document.getElementById("number").value;
		let visibility = getComputedStyle(document.getElementById("heart_mark_" + number)).visibility;
		
		if (visibility == "hidden") {
			const xhr = new XMLHttpRequest();
			xhr.open("POST", "/local/components/dohuze/CollectionSertificates/templates/.default/handler_input.php");
			xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
			const body = JSON.stringify({
				userID: document.getElementById("active").getAttribute("data-number"),
				number: number,
			});

			xhr.onload = () => {
				if (xhr.readyState == 4 && xhr.status == 200) {
					//console.log(JSON.parse(xhr.responseText));
					if (xhr.responseText) {
						document.getElementById("heart_mark_" + number).style.visibility = "visible";
						document.getElementById("date_" + number).innerHTML = "Дата и время активации:<br>" + xhr.responseText;
					}
				} else {
					console.log(`Error`);
				}
			};
			xhr.send(body);
		} else {
			alert("Сертификат " + number + " уже был ранее вами активирован.");
		}
	})
	
	var elements = document.getElementsByClassName("activ");
	for (var i = 0; i < elements.length; i++) {
		elements[i].addEventListener("click", function() {
			let visibility = getComputedStyle(document.getElementById("heart_mark_" + this.id)).visibility;

			if (visibility == "hidden") {
				const xhr = new XMLHttpRequest();
				xhr.open("POST", "/local/components/dohuze/CollectionSertificates/templates/.default/handler_input.php");
				xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
				const body = JSON.stringify({
					userID: document.getElementById("active").getAttribute("data-number"),
					number: this.id,
				});

				xhr.onload = () => {
					if (xhr.readyState == 4 && xhr.status == 200) {
						//console.log(JSON.parse(xhr.responseText));
						if (xhr.responseText) {
							document.getElementById("heart_mark_" + this.id).style.visibility = "visible";
							document.getElementById("date_" + this.id).innerHTML = "Дата и время активации:<br>" + xhr.responseText;
						}
					} else {
						console.log(`Error`);
					}
				};
				xhr.send(body);
			} else {
				alert("Сертификат " + this.id + " уже был ранее вами активирован.");
			}
		})
	}
	

		
		
		
		


	
	
	
	
	
	
	
});