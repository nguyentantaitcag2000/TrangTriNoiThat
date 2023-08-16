<?php
?>
<button type="button" data-bs-toggle="modal" data-bs-target="#insertModal" data-bs-whatever="@mdo" class="btn btn-success m-3">New category</button>

<h3>Danh sách các danh mục:</h3>

<div class="container">
  <div class="row">
    <div class="col-12">
		<table id="table" class="table table-image">
		  <thead>
		    <tr>
		      <th scope="col">Ảnh danh mục</th>
		      <th scope="col">Tên</th>
		      <th scope="col">Hành động</th>
		    </tr>
		  </thead>
		  <tbody id="category_list" >
		    
	    	<?php
	    		require_once('./mvc/core/ajax/Load-Category.php');
	      ?>
		   
		  </tbody>
		</table>   
    </div>
  </div>
</div>
<div id="thongbao"></div>
<!-- INSERT MODEL -->
<div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert a new category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id='insert_form'>
	          <div class="mb-3">
	            <label for="image_category" class="col-form-label">Ảnh sản phẩm đại diện:</label>
	            <input type="file" class="form-control" id="image_category" accept="image/*" required>
	            <img src="" style="padding: 10px; width: 85px;">
	          </div>
	          <div class="mb-3">
	            <label for="name_category" class="col-form-label">Tên danh mục:</label>
	            <input type='text' class="form-control" id="name_category" required></input>
	          </div>
	          <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary" id="insert_product">Insert</button>
		      </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- UPDATE MODEL -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id='update_form'>
	          <input type="text" class="form-control" id="id_category_update" hidden>

	          <div class="mb-3">
	            <label for="image_category_update" class="col-form-label">Ảnh sản phẩm:</label>
	            <input type="file" class="form-control" id="image_category_update">
	            <img src="" style="padding: 10px; width: 85px;">
	          </div>
	         
	          <div class="mb-3">
	            <label for="name_product_update" class="col-form-label">Tên danh mục:</label>
	            <input type='text' class="form-control" id="name_product_update" required></input>
	          </div>
	          
	          <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary" id="update_product">Update</button>
		      </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
      	var base64Image_Array = [];
      	function readFile() {
      		var input = this;
  				function readFileByIndex(index)
  				{
  					if (!input.files || !input.files[index]) return;
					    
					  const FR = new FileReader();
					  
					  FR.addEventListener("load", function(evt) {

					    base64Image_Array[0] = evt.target.result;
				    	var img = input.nextElementSibling;
					  	img.setAttribute('src', evt.target.result);
					    
					  });
					  FR.readAsDataURL(input.files[index]);
  				}
					   
				  if(this.files.length == 1)
				  {
				  	readFileByIndex(0);
				  }
				  else
				  {
				  	for(var i = 0; i < this.files.length; i ++)
				  		readFileByIndex(i);
				  }
				}
				function DeleteImage()
				{
					this.parentElement.remove();
					for (var i = 0; i < base64Image_Array.length; i++) {
						if(base64Image_Array[i] == this.nextElementSibling.src)
						{
							var index = base64Image_Array.indexOf(base64Image_Array[i]);
							if (index > -1) { // only splice array when item is found
							  base64Image_Array.splice(index, 1); // 2nd parameter means remove one item only
							}
							break;
						}
					}
				}
				function UploadImage()
				{
					 readFile();
				}
				document.querySelector("#image_category").addEventListener("change", readFile);
				document.querySelector("#image_category_update").addEventListener("change", readFile);

			  document.getElementById('insert_form').addEventListener('submit',function(event){
			  	var name_category = document.getElementById('name_category').value;
			  	
			  	var avt_image_input = document.getElementById('image_category');
				  var avt_image_file = avt_image_input.files[0];
				  var avt_image_name = avt_image_file.name;

				  var formData = new FormData();
				  formData.append('image_category', avt_image_file, avt_image_name);
				  formData.append('name_category', name_category);
				  if( avt_image_file == null)
				  {
				    alert('Hình ảnh chưa được chọn !');
				    return;
				  }
					Swal.fire({
		        title: "Đang thêm vào...",
		        text: "Please wait",
		        imageUrl: "../../../public/images/loading.gif",
		        showConfirmButton: false,
		        allowOutsideClick: false
		      });

					$.ajax({
						url:"../../../mvc/core/ajax/Insert-Category.php",
						method: "POST",
						data: formData,
						contentType: false,
				    processData: false,
						success: function(res)
						{
							Swal.close();
							document.getElementById('insert_form').reset();
							document.getElementById('insertModal').getElementsByTagName('button')[0].click();
							$('#thongbao').html(res);
							$.ajax({
								url:'../../../mvc/core/ajax/Load-Category.php',
								method:'GET',
								success:function(res2){
									 $('#category_list').html(res2);
								}
							})
						}
					});			
		});
			
			  function EnterMoney(event)
			  {
			  	 var input = event.target;
			  	 var p = input.nextElementSibling;
			  	 var docTien = new DocTienBangChu();
			  	 p.innerHTML = docTien.doc(input.value);;
			  }
			  function UpdateCategory(event, ID)
			  {
			  		document.getElementById('update_form').reset();
			  		var productName = event.target.getAttribute('data-product-name');
			  		var image_category_update = event.target.getAttribute('data-product-image');
			  		$('#name_product_update').val(productName);

			  		$('#id_category_update').val(ID);
			  		base64Image_Array = [];
			  		base64Image_Array[base64Image_Array.length] = image_category_update;
			  		document.getElementById('image_category_update').nextElementSibling.src = image_category_update;
			  		
			  }
			 document.getElementById('update_form').addEventListener('submit',function(event){
				  event.preventDefault();
				  var name_category = document.getElementById('name_product_update').value;
				  var id_category = document.getElementById('id_category_update').value;
				  var formData = new FormData();
				  var avt_image_input = document.getElementById('image_category_update');
				  if(avt_image_input.files.length > 0){
				    var avt_image_file = avt_image_input.files[0];
				    var avt_image_name = avt_image_file.name;
				    formData.append('image_category', avt_image_file, avt_image_name);
				  }
				  formData.append('name_category', name_category);
				  formData.append('id_category', id_category);

				  if(avt_image_input.files.length === 0 && name_category === ''){
				    alert('Vui lòng nhập đầy đủ thông tin !');
				    return;
				  }
				  Swal.fire({
				    title: "Đang cập nhật...",
				    text: "Please wait",
				    imageUrl: "../../../public/images/loading.gif",
				    showConfirmButton: false,
				    allowOutsideClick: false
				  });

				  $.ajax({
				    url:"../../../mvc/core/ajax/Update-Category.php",
				    method: "POST",
				    data: formData,
				    contentType: false,
				    processData: false,
				    success: function(res){
				      Swal.close();
				      document.getElementById('update_form').reset();
				      document.getElementById('updateModal').getElementsByTagName('button')[0].click();
				      $('#thongbao').html(res);
				      base64Image_Array = [];
				      $.ajax({
				        url:'../../../mvc/core/ajax/Load-Category.php',
				        method:'GET',
				        success:function(res2){
				          $('#category_list').html(res2);
				        }
				      })
				    }
				  });				
				});
			  function DeleteProduct(ID)
			  {
			  	Swal.fire({
					  title: 'Are you sure?',
					  text: "You won't be able to revert this!",
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
					  if (result.isConfirmed) {
					  	Swal.fire({
				        title: "Đang xoá...",
				        text: "Please wait",
				        imageUrl: "../../../public/images/loading.gif",
				        showConfirmButton: false,
				        allowOutsideClick: false
				      });

					  	$.ajax({
					  		url:"../../../mvc/core/ajax/Delete-Category.php",
					  		method:'POST',
					  		data:{ID:ID},
					  		success:function(res) {
					  				Swal.close();
					  				$('#thongbao').html(res);
					  				$.ajax({
											url:'../../../mvc/core/ajax/Load-Category.php',
											method:'GET',
											success:function(res2){
												 $('#category_list').html(res2);
											}
										})
					  		}
					  	});
					  }
					})
			  }
</script>
<script>
	$('#table').DataTable();
</script>