
//śmietnik


$(function(){
	
})


$("#OrdersButton").on('click', function() {
	var me = this
	e.preventDefault()
//    console.log($("#addForm").serialize())
	var allBooks = $.ajax({
		url: "./../api/users.php", 
		data: {},
		type: "GET",
		dataType : "json"})
		.done(function(json) {
			$(json).each(function(){
				var  = $("#booksList")
				var newDiv = $('<div class="book">')
				newDiv.attr('id', JSON.parse(this).id)
				newDiv.html('<div class="title">'+(JSON.parse(this)).title+'</div><div class="desc hidden"></div><div class="deleteBtnCntr"><button type="button" class="deleteBtn" id="'+JSON.parse(this).id+'">Delete this book</button></div>')
				newDiv.appendTo(booksList)
			})
			showDescription()
			deleteButtonsFunc()
		});
});

}


function loadAllBooks() {
	var allBooks = $.ajax({
		url: "./api/books.php", 
		data: {},
		type: "GET",
		dataType : "json"})
		.done(function(json) {
			$(json).each(function(){
				var booksList = $("#booksList")
				var newDiv = $('<div class="book">')
				newDiv.attr('id', JSON.parse(this).id)
				newDiv.html('<div class="title">'+(JSON.parse(this)).title+'</div><div class="desc hidden"></div><div class="deleteBtnCntr"><button type="button" class="deleteBtn" id="'+JSON.parse(this).id+'">Delete this book</button></div>')
				newDiv.appendTo(booksList)
			})
			showDescription()
			deleteButtonsFunc()
		});
}

//not used in API
function addLastAddedBook(id) {
	var selectedBook = $.ajax({
		url: "./api/books.php?id="+id, 
		data: {},
		type: "GET",
		dataType : "json"})
		.done(function(json) {
				var booksList = $("#booksList")
				var newDiv = $('<div class="book">')
				newDiv.attr('id', json.id)
				newDiv.html('<div class="title">'+json.title+'</div><div class="desc hidden"></div><div><button class="deleteBtn" id='+json.id+'</div>')
				newDiv.appendTo(booksList)
			}
		);
}

function showDescription() {
	$('.title').on('click', function(){
		var me = this //Setting scope for ajax function 
		var id = $(this).parent().attr('id')
		var bookDetails = $.ajax({
			url: ("./api/books.php?id="+id),
			type: "GET",
			dataType: "json"
		}).done(function(json){
			var details = ("Author: "+json.author+"<br>Description: "+json.description)
			$(me).next().html(details) 
			$(me).next().toggleClass('hidden')
		})
	})
}

function deleteButtonsFunc() {
	$('.deleteBtn').on('click', function(){
		console.log("Click")
		var id = $(this).attr('id')
		$.ajax({
			type: "DELETE",
			url: "./api/books.php",
			data: {id},
			dataType: "json"
		})
		.done(function(json){
			alert(json)
			$('#booksList').html('')
			loadAllBooks()
		})
	})
}


$("#addForm").submit(function(e) {
	var me = this
	e.preventDefault()
//    console.log($("#addForm").serialize())
	var addBook = $.ajax({
		type: "POST",
		url: "./api/books.php",
		data: $("#addForm").serialize(),
		dataType: "json"})
		.done(function(json) {
			var array = json;
			if (array[0] != false) {
				alert(array[1])
				$(me).trigger("reset");
				$('#booksList').html('')
				loadAllBooks()
			}
			else {
				alert(array[1])
			}
		});
});

