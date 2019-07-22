var topicArray = new Array();
var topicCount = 0;
var username = document.getElementById('text').innerHTML;
const pop = new Audio();
pop.src = "pop.mp3";

function initiate(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200)
		{
			values = this.responseText.split("|");
			names = values[0].split(",");
			contents = values[1].split("^");
			upvotes = values[2].split(",");
			downvotes = values[3].split(",");
			comments = values[4].split(",");

			if(names[0] != "")
			{
				for (var i = names.length - 1; i >= 0; i--) {
					topicCount++;
					topicCreate(i,names[i],contents[i],upvotes[i],downvotes[i],comments[i]);
				}
			}
		}
	};
	xhttp.open("GET","topicQuery.php",false);
	xhttp.send();
}

function topicCreate(i,name,content,uCount,dCount,cCount)
{
	topicArray[i] = document.createElement("div");
	topicArray[i].style.textAlign = "left";
	topicArray[i].style.marginBottom = "30px";
	topicArray[i].style.position = "relative";
	topicArray[i].style.left = "10%" ;
	topicArray[i].id = name;
	topicArray[i].style.width = "80%";
	topicArray[i].id = name;
	document.body.appendChild(topicArray[i]);

	head = document.createElement("h1");
	head.innerHTML = name;
	head.style.color = "white";
	//head.style.borderBottom = "1px solid blue";
	head.style.backgroundColor = "#7aabfa";
	head.style.width = "100%";
	head.style.borderTopLeftRadius = "20px";
	head.style.borderTopRightRadius = "20px";
	head.style.margin = "0px";
	head.style.padding = "20px";
	topicArray[i].append(head);

	box = document.createElement("span");
	box.style.display = "none";
	box.style.backgroundColor = "white";
	box.style.color = "black";
	box.style.fontFamily = "Arial";
	box.style.fontWeight = "100";
	box.style.fontSize = "15px";
	box.style.position = "absolute";
	box.style.top = "20px";
	box.style.right = "45px";
	box.style.cursor = "pointer";
	box.id = name + "box";
	box.style.boxShadow = "5px 5px 4px grey";
	head.append(box);	

	edit = document.createElement("div");
	edit.innerHTML = "Edit Content";
	edit.style.padding = "10px";
	edit.addEventListener("click",function(){
		editContent(name,content);
	});
	box.append(edit);

	remove = document.createElement("div");
	remove.style.padding = "10px";
	remove.innerHTML = "Remove Content";
	remove.addEventListener("click",function(){
		removeContent(name);
	});
	box.append(remove);

	tri = document.createElement("div");
	tri.style.height = "0px";
	tri.style.width = "0px";
	tri.style.backgroundColor = "transparent";
	tri.style.borderLeft = "12px solid white";
	tri.style.borderTop = "9px solid transparent";
	tri.style.borderBottom = "9px solid transparent";
	tri.style.position = "absolute";
	tri.style.right = "-12px";
	tri.style.top = "6px";
	edit.append(tri);

	btn = document.createElement("button");
	btn.style.position = "absolute";
	btn.style.top = "20px";
	btn.style.backgroundColor = "#7aabfa";
	btn.style.fontSize = "22px";
	btn.style.padding = "2px 13px 2px 13px";
	btn.style.borderRadius = "16px";
	btn.style.border = "none";
	btn.style.right = "0px";
	btn.addEventListener("click",function(){
		editDisplay(name);
	});
	head.append(btn);

	fa = document.createElement("i");
	fa.className = "fa fa-ellipsis-v";
	btn.append(fa);


	body = document.createElement("p");
	body.style.padding = "20px";
	body.style.backgroundColor = "#c4d6f2";
	body.style.margin = "0px";
	body.style.width = "100%";
	body.id = name + "body";
	body.innerHTML = content;
	topicArray[i].append(body);

	foot = document.createElement("div");
	foot.id = name + "foot";
	foot.style.borderBottomLeftRadius = "20px";
	foot.style.borderBottomRightRadius = "20px";
	foot.style.width = "100%";
	foot.style.padding = "20px";
	foot.style.display = "inline-flex";
	topicArray[i].append(foot);

	tu = document.createElement("i");
	tu.className = "fa fa-thumbs-o-up";
	tu.style.position = "relative";
	tu.style.left = "10px";
	tu.style.top = "5px";
	tu.style.fontSize = "20px";
	tu.id = name+"tu";
	foot.append(tu);

	upvote = document.createElement("span");
	upvote.style.padding = "5px";
	upvote.innerHTML = "upvote";
	upvote.style.cursor = "pointer";
	upvote.style.position = "relative";
	upvote.style.left = "20px";
	foot.append(upvote);

	upvoteCount = document.createElement("span");
	upvoteCount.style.position = "relative";
	upvoteCount.style.left = "35px";
	upvoteCount.style.top = "5px";
	upvoteCount.style.color = "white";
	upvoteCount.id = name + "up";
	upvoteCount.innerHTML = uCount;
	foot.append(upvoteCount);

	td = document.createElement("i");
	td.className = "fa fa-thumbs-o-down";
	td.style.position = "relative";
	td.style.left = "140px";
	td.style.top = "5px";
	td.style.fontSize = "20px";
	td.id = name + "td";
	foot.append(td);

	downvote = document.createElement("span");
	downvote.style.padding = "5px";
	downvote.innerHTML = "downvote";
	downvote.style.cursor = "pointer";
	downvote.style.position = "relative";
	downvote.style.left = "160px";
	foot.append(downvote);

	downvoteCount = document.createElement("span");
	downvoteCount.style.position = "relative";
	downvoteCount.style.left = "180px";
	downvoteCount.style.top = "5px";
	downvoteCount.style.color = "white";
	downvoteCount.id = name + "down";
	downvoteCount.innerHTML = dCount;
	foot.append(downvoteCount);

	weixin = document.createElement("i");
	weixin.className = "fa fa-weixin";
	weixin.style.position = "relative";
	weixin.style.left = "300px";
	weixin.style.top = "5px";
	weixin.style.fontSize = "20px";
	foot.append(weixin);

	//code for comments
	commentBtn = document.createElement("span");
	commentBtn.innerHTML = "comment";
	commentBtn.style.padding = "5px";
	commentBtn.style.cursor = "pointer";
	commentBtn.style.position = "relative";
	commentBtn.style.left = "310px";
	commentBtn.addEventListener("click",function(){
		comment(name,content);
	});
	foot.append(commentBtn);

	commentCount = document.createElement("span");
	commentCount.style.position = "relative";
	commentCount.style.left = "320px";
	commentCount.style.top = "5px";
	commentCount.style.color = "white";
	commentCount.innerHTML = cCount;
	foot.append(commentCount);


	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200)
		{
			var values = this.responseText.split("|");

			document.getElementById("ustatus").innerHTML = values[0];
			document.getElementById("dstatus").innerHTML = values[1];

			if(values[0] == 2)
				tu.className = "fa fa-thumbs-up";
			else if(values[0] == 1)
				tu.className = "fa fa-thumbs-o-up";

			if(values[1] == 2)
				td.className = "fa fa-thumbs-down";
			else if(values[1] == 1)
				td.className = "fa fa-thumbs-o-down";

			tu.addEventListener("click",function(){
				var u = 1,d = 1;
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200)
					{
						var values = this.responseText.split("|");

						u = parseInt(values[0],10);
						d = parseInt(values[1],10);
					}
				};
				xhttp.open("GET","voteQuery.php?topic="+name+"&user="+username,false);
				xhttp.send();
				upvoteUpdate(name,u,d);
			});
			td.addEventListener("click",function(){
				var u = 1,d = 1;
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200)
					{
						var values = this.responseText.split("|");

						u = parseInt(values[0],10);
						d = parseInt(values[1],10);
					}
				};
				xhttp.open("GET","voteQuery.php?topic="+name+"&user="+username,false);
				xhttp.send();
				downvoteUpdate(name,u,d);
			});
		}
	};
	xhttp.open("GET","voteQuery.php?topic="+name+"&user="+username,false);
	xhttp.send();
}

function removeContent(name)
{
	document.getElementById(name).style.display = "none";
	var xhttp = new XMLHttpRequest();
	xhttp.open("GET","deleteTopic.php?topicname="+name);
	xhttp.send();
}

function editDisplay(name)
{
	var str = name + "box";
	if(document.getElementById(str).style.display == "block")
		document.getElementById(str).style.display = "none";
	else if(document.getElementById(str).style.display == "none")
		document.getElementById(str).style.display = "block";
}

function comment(name,content)
{
	var type = document.getElementById("actype").innerHTML;
	window.location = "comment.php?name="+name+"&content="+content+"&username="+username+"&actype="+type;
}

function upvoteUpdate(name,u,d){
	var str = name + "tu";
	var id = name + "up";

	if(d == 1)//not downvoted, hence upvote shall work
	{
		if(u == 1)//code for upvote increase
		{
			pop.play();
			var command = 1;
			document.getElementById(str).className = "fa fa-thumbs-up";
			//create upvote in table myVote
			var code = 1;
			var xhttp = new XMLHttpRequest();
			xhttp.open("GET","vote.php?topic="+name+"&user="+username+"&code="+code);
			xhttp.send();
			//update topicTable using upvote.php
			var xhttp = new XMLHttpRequest();
			xhttp.open("GET","upvote.php?topicname="+name+"&command="+command);
			xhttp.send();
			//update home.php
			var num =  document.getElementById(id).innerHTML;
			num = parseInt(num,10);
			num++;
			document.getElementById(id).innerHTML = num;
		}
		else if(u == 2)// code for upvote decrease
		{
			pop.play();
			var command = 0;
			document.getElementById(str).className = "fa fa-thumbs-o-up";
			//delete upvote in table myVote
			var code = 2;
			var xhttp = new XMLHttpRequest();
			xhttp.open("GET","vote.php?topic="+name+"&user="+username+"&code="+code);
			xhttp.send();
			//update topicTable using upvote.php
			var xhttp = new XMLHttpRequest();
			xhttp.open("GET","upvote.php?topicname="+name+"&command="+command);
			xhttp.send();
			//update home.php
			var num =  document.getElementById(id).innerHTML;
			num = parseInt(num,10);
			num--;
			document.getElementById(id).innerHTML = num;
		}
	}
}

function downvoteUpdate(name,u,d){
	var str = name + "td";
	var id = name + "down";

	if(u == 1)//not upvoted, hence downvote shall work
	{
		if(d == 1)// code for downvote increase
		{
			pop.play();
			var command = 1;
			document.getElementById(str).className = "fa fa-thumbs-down";
			//create downvote in table myVote
			var code = 3;
			var xhttp = new XMLHttpRequest();
			xhttp.open("GET","vote.php?topic="+name+"&user="+username+"&code="+code);
			xhttp.send();
			//update topicTable using downvote.php
			var xhttp = new XMLHttpRequest();
			xhttp.open("GET","downvote.php?topicname="+name+"&command="+command);
			xhttp.send();
			//update home.php
			var num =  document.getElementById(id).innerHTML;
			num = parseInt(num,10);
			num++;
			document.getElementById(id).innerHTML = num;
		}
		else if(d == 2)// code for downvote decrease
		{
			pop.play();
			var command = 0;
			document.getElementById(str).className = "fa fa-thumbs-o-down";
			//delete downvote in table myVote
			var code = 4;
			var xhttp = new XMLHttpRequest();
			xhttp.open("GET","vote.php?topic="+name+"&user="+username+"&code="+code);
			xhttp.send();
			//update topicTable using downvote.php
			var xhttp = new XMLHttpRequest();
			xhttp.open("GET","downvote.php?topicname="+name+"&command="+command);
			xhttp.send();
			//update home.php
			var num =  document.getElementById(id).innerHTML;
			num = parseInt(num,10);
			num--;
			document.getElementById(id).innerHTML = num;
		}
	}
}