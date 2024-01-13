<?php
ini_set('mysql.connect_timeout',300);
ini_set('default_socket_timeout',300);
//Dòng 2,3 giúp cho việc upload file có hình ảnh lớn không bị lỗi "MySQL: Warning: MySQL server has gone away"
//Ngoài việc thêm 2 dòng đó còn phải vào my.ini sửa lại 2 dòng max_allowed_packet tầm 10M trở lên
//Chi tiết xem ở video : https://www.youtube.com/watch?v=60A0r-eGRoY
?>
<button type="button" data-bs-toggle="modal" data-bs-target="#insertModal" data-bs-whatever="@mdo" class="btn btn-success m-3">New product</button>
<button type="button" data-bs-toggle="modal" data-bs-target="#uploadModal" data-bs-whatever="@mdo" class="btn btn-success m-3">Upload file .csv</button>

<h3>Danh sách các sản phẩm:</h3>


<table id="table" class="table table-image" data-sort-name="ID" data-sort-order="desc">
	<thead>
	<tr>
		<th scope="col">ID</th>
		<th scope="col">Ảnh sản phẩm</th>
		<th scope="col">Tên</th>
		<th scope="col">Màu sắc</th>
		<th scope="col">Chất liệu</th>
		<th scope="col">Mô tả</th>
		<th scope="col">Giá</th>
		<th scope="col">Danh mục</th>
		<th scope="col">Hành động</th>
	</tr>
	</thead>
	<tbody id="product_list" >
	
	<?php
		require_once('./mvc/core/ajax/Load-Product.php');
	?>
	
	</tbody>
</table>   


<div id="thongbao"></div>
<!-- INSERT MODEL -->
<div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert a new product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id='insert_form'>
	          <div class="mb-3">
	            <label for="image_product" class="col-form-label">Ảnh sản phẩm đại diện:</label>
	            <input type="file" class="form-control" id="image_product" accept="image/png, image/jpeg, image/jpg" required>
	            <img id="avt" src="" style="padding: 10px; width: 85px;">
	          </div>
	          <div class="mb-3">
	            <label for="detail_image_product" class="col-form-label">Ảnh sản phẩm chi tiết:</label>
	            <input type="file" class="form-control" id="detail_image_product" accept="image/png, image/jpeg, image/jpg"  multiple>
	            <div class="container"></div>
	          </div>
	          <div class="mb-3">
	            <label for="name_product" class="col-form-label">Danh mục sản phẩm:</label>
	            <select id="category_product" class="form-select" required>
	            	<?php foreach ($data['ListCategory'] as $key => $value) { ?>
	            		<option value="<?=$value['ID_Category']?>"><?=$value['Name_Category']?></option>
	            	<?php }?>
							</select>
	          </div>
	          <div class="mb-3">
	            <label for="name_product" class="col-form-label">Tên sản phẩm:</label>
	            <input type='text' class="form-control" id="name_product" required></input>
	          </div>
	          <div class="mb-3">
	            <label for="description_product" class="col-form-label">Mô tả sản phẩm:</label>
	            <textarea class="form-control" id="description_product" required></textarea>
	          </div>
	          <div class="mb-3">
	            <label for="size_product" class="col-form-label">Kích thước:</label>
	            <input type='text' class="form-control" id="size_product"></input>
	          </div>
	          <div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <label class="input-group-text" for="inputGroupSelect01">Chất liệu:</label>
						  </div>
						  <select class="custom-select" id="material_product">
						    <?php foreach ($data['ListMaterial'] as $key => $value) { ?>
						    	<option value="<?=$value['ID_Material']?>"><?=$value['Name_Material']?></option>
						    <?php }?>
						  </select>
						  <div class="container"></div>
						  <input id="material_list" type="text" hidden />
						</div>
	          <div class="mb-3">
					    <label class="form-label" for="price_product">Giá:</label>
	          	<input type="number" id="price_product" class="form-control" onkeyup="EnterMoney(event)" onclick="EnterMoney(event)" required/>
	          	<p></p>
	          </div>
	      
	          <div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <label class="input-group-text" for="inputGroupSelect01">Màu sắc:</label>
						  </div>
						  <select class="custom-select" id="color_product">
						    <?php foreach ($data['ListColor'] as $key => $value) { ?>
						    	<option value="<?=$value['ID_Color']?>"><?=$value['Name_Color']?></option>
						    <?php }?>
						  </select>
						  <div class="container"></div>
						  <input id="color_list" type="text" hidden />
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
	          <input type="text" class="form-control" id="id_product_update" hidden>

	          <div class="mb-3">
	            <label for="image_product_update" class="col-form-label">Ảnh sản phẩm:</label>
	            <input type="file" class="form-control" id="image_product_update" accept="image/png, image/jpeg, image/jpg">
	            <img src="" style="padding: 10px; width: 85px;">
	          </div>
	           <div class="mb-3">
	            <label for="detail_image_product_update" class="col-form-label">Ảnh sản phẩm chi tiết:</label>
	            <input type="file" class="form-control" id="detail_image_product_update" accept="image/png, image/jpeg, image/jpg"  multiple>
	            <div></div>
	          </div>
	          <div class="mb-3">
	            <label for="name_product_update" class="col-form-label">Danh mục sản phẩm:</label>
	            <select id="category_product_update" class="form-select" required>
	            	<?php foreach ($data['ListCategory'] as $key => $value) { ?>
	            		<option value="<?=$value['ID_Category']?>"><?=$value['Name_Category']?></option>
	            	<?php }?>
							</select>
	          </div>
	          <div class="mb-3">
	            <label for="name_product_update" class="col-form-label">Tên sản phẩm:</label>
	            <input type='text' class="form-control" id="name_product_update" required></input>
	          </div>
	          <div class="mb-3">
	            <label for="description_product_update" class="col-form-label">Mô tả sản phẩm:</label>
	            <textarea class="form-control" id="description_product_update" required></textarea>
	          </div>
	          <div class="mb-3">
	            <label for="size_product_update" class="col-form-label">Kích thước:</label>
	            <input type='text' class="form-control" id="size_product_update"></input>
	          </div>
	          <div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <label class="input-group-text" for="inputGroupSelect01">Chất liệu:</label>
						  </div>
						  <select class="custom-select" id="material_product_update">
						    <?php foreach ($data['ListMaterial'] as $key => $value) { ?>
						    	<option value="<?=$value['ID_Material']?>"><?=$value['Name_Material']?></option>
						    <?php }?>
						  </select>
						  <div class="container"></div>
						  <input id="material_list_update" type="text" hidden />
						</div>
	          <div class="mb-3">
					    <label class="form-label" for="price_product_update">Giá:</label>
	          	<input type="number" id="price_product_update" class="form-control" onkeyup="EnterMoney(event)" onclick="EnterMoney(event)" required/>
	          	<p></p>
	          </div>
	          <div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <label class="input-group-text" for="inputGroupSelect01">Màu sắc:</label>
						  </div>
						  <select class="custom-select" id="color_product_update">
						    <?php foreach ($data['ListColor'] as $key => $value) { ?>
						    	<option value="<?=$value['ID_Color']?>"><?=$value['Name_Color']?></option>
						    <?php }?>
						  </select>
						  <div class="container"></div>
						  <input id="color_list_update" type="text" hidden />
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
<!-- UPDATE .CSV MODEL -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload products by .csv file</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id='uploadForm'  enctype="multipart/form-data">
        		<p>Định dạng: Tiêu đề, mô tả, id category, giá</p>
	          <input type="file" name="fileToUpload" id="fileToUpload">
	          <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary" id="upload_product">Update</button>
		      </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
      	var base64Image_Array = [];
      	var lisDetailtFiles = [];
      	var lisDetailtFiles_Update = [];
      	function readFileDetail()
      	{
      		var input = this;
      		for (var i = 0; i < input.files.length; i++) {
      			lisDetailtFiles[lisDetailtFiles.length] = input.files[i]
      		}
      	}
      	function readFileDetail_Update()
      	{
      		var input = this;
      		for (var i = 0; i < input.files.length; i++) {
      			lisDetailtFiles_Update[lisDetailtFiles_Update.length] = input.files[i];
      			const reader = new FileReader();
						reader.readAsDataURL(input.files[i]);
						reader.onload = function() {
							  var div = input.nextElementSibling.firstChild;
					    	 if(div==null)
					    	 {
					    	 		var div2 = document.createElement('div');
					    	 		div2.className = 'row';
					    	 		input.nextElementSibling.appendChild(div2);
					    	 		div = input.nextElementSibling.firstChild;
					    	 }
					    	 var box = document.createElement('div');
			  					box.style.position = 'relative';
			  					box.className='col-md-auto';

			  					var icon_delete = document.createElement('span');
			  					icon_delete.className ='close btn';
			  					icon_delete.innerHTML = ' &times;';
			  					icon_delete.style = 'position:absolute;background-color:#fff;color:red;right:10px;padding: 0';
			  					icon_delete.addEventListener('click',DeleteImage);
			  					box.appendChild(icon_delete); 
			  					var img = document.createElement('img');
			  					img.src = reader.result;
			  					img.setAttribute('width','85px');
						  	  img.style.padding = '10px';	
			  					box.appendChild(img);

			  					div.appendChild(box); 
			  					input.value='';
						}
      			
      		}

      	}
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
				function addColor()
				{
					if(this.value == 0)
		    	 			return;
					var div = this.nextElementSibling.firstChild;

					if(div==null)
					{

							var div2 = document.createElement('div');
							div2.className = 'row';
							this.nextElementSibling.appendChild(div2);
							div = this.nextElementSibling.firstChild;
					}
					var inputHidden = this.nextElementSibling.nextElementSibling;
					var box = document.createElement('div');
  					box.style.position = 'relative';
  					box.className='col-md-auto';

  					var icon_delete = document.createElement('span');
  					icon_delete.className ='close btn';
  					icon_delete.innerHTML = ' &times;';
  					icon_delete.style = 'position:absolute;background-color:#fff;color:red;right:10px;padding: 0';
  					icon_delete.setAttribute('data-input-id', inputHidden.id);
  					icon_delete.addEventListener('click',DeleteColorItem);
  					box.appendChild(icon_delete); 
  					var span = document.createElement('span');
  					span.textContent = this.options[this.selectedIndex].text;
  					span.setAttribute('data-id',this.value);debugger;
  					var rg = new RegExp(`,${this.value}|${this.value}|${this.value},`); // Nếu đã có chứa mã màu này rồi thì sẽ không thêm
  					if(!rg.test(inputHidden.value))
  					{
  						if(inputHidden.value == '')
	  						inputHidden.value = this.value;
	  					else
	  						inputHidden.value +=',' + this.value;

	  					span.setAttribute('width','85px');
				  	  span.style.padding = '10px';	
	  					box.appendChild(span);

	  					div.appendChild(box); 	
  					}
  					else if(!rg.test(inputHidden.value) && !div.innerHTML)
  					{
  							span.setAttribute('width','85px');
					  	  span.style.padding = '10px';	
		  					box.appendChild(span);

		  					div.appendChild(box);
  					}
  					else
  					{
  						alert("Màu này đã được thêm vào");
  					}
  					
				}
				function DeleteColorItem()
				{
					var id_input = this.getAttribute('data-input-id');
					this.parentElement.remove();
					var text = this.nextElementSibling.getAttribute('data-id');
  				colorList_input = document.getElementById(id_input);
					colorList_input.value =  colorList_input.value.replace( text + ',' , '').replace( ',' + text, '').replace(text,'');
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
				 document.querySelector("#image_product").addEventListener("change", readFile);
				 document.querySelector("#detail_image_product").addEventListener("change", readFileDetail);
				document.querySelector("#detail_image_product_update").addEventListener("change", readFileDetail_Update);
				document.querySelector("#image_product_update").addEventListener("change", readFile);
				document.querySelector("#color_product").addEventListener("change", addColor);
				document.querySelector("#color_product_update").addEventListener("change", addColor);
				document.querySelector("#material_product").addEventListener("change", addColor);
				document.querySelector("#material_product_update").addEventListener("change", addColor);
			  document.getElementById('insert_form').addEventListener('submit',function(event){

				  var name_product = document.getElementById('name_product').value;
				  var description_product = document.getElementById('description_product').value;
				  var price_product = document.getElementById('price_product').value;
				  var category_product = document.getElementById('category_product').value;
				  var color_list = document.getElementById('color_list').value;
				  var material_list = document.getElementById('material_list').value;
				  var size_product = document.getElementById('size_product').value;
				  var material_product = document.getElementById('material_product').value;
				  event.preventDefault();

				  var avt_image_input = document.getElementById('image_product');
				  var avt_image_file = avt_image_input.files[0];
				  var avt_image_name = avt_image_file.name;

				  var detail_image_files = lisDetailtFiles;
				  var detail_image_names = [];
				  for (var i = 0; i < detail_image_files.length; i++) {
				    detail_image_names.push(detail_image_files[i].name);
				  }

				  var formData = new FormData();
				  formData.append('image_product', avt_image_file, avt_image_name);
				  for (var i = 0; i < detail_image_files.length; i++) {
				    formData.append('detail_image_product[]', detail_image_files[i], detail_image_names[i]);
				  }
				  formData.append('name_product', name_product);
				  formData.append('description_product', description_product);
				  formData.append('price_product', price_product);
				  formData.append('category_product', category_product);
				  formData.append('color_list', color_list);
				  formData.append('material_list', material_list);
				  formData.append('size_product', size_product);
				  formData.append('material_product', material_product);

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
				    url:"../../../mvc/core/ajax/Insert-Product.php",
				    method: "POST",
				    data: formData,
				    contentType: false,
				    processData: false,
				    success: function(res)
				    {
				    	lisDetailtFiles = [];
				      Swal.close();
				      document.getElementById('insert_form').reset();
				      document.getElementById('insertModal').getElementsByTagName('button')[0].click();
				      $('#thongbao').html(res);
				      $.ajax({
				        url:'../../../mvc/core/ajax/Load-Product.php',
				        method:'GET',
				        success:function(res2){
				           $('#product_list').html(res2);
				           document.getElementById('avt').src = '';
				        }
				      })
				    }
				  });     
				});
				document.getElementById('uploadForm').addEventListener('submit',function(event){
					var formData = new FormData($("#uploadForm")[0]);
					event.preventDefault();

					
					Swal.fire({
		        title: "Đang thêm vào...",
		        text: "Please wait",
		        imageUrl: "../../../public/images/loading.gif",
		        showConfirmButton: false,
		        allowOutsideClick: false
		      });
					$.ajax({
		        url: "../../../mvc/core/ajax/Upload-Product-CSV.php",
		        type: "POST",
		        data: formData,
		        processData: false,
		        contentType: false,
		        success: function(res) {
		        	Swal.close();
							document.getElementById('uploadModal').getElementsByTagName('button')[0].click();
							$('#thongbao').html(res);
							$.ajax({
								url:'../../../mvc/core/ajax/Load-Product.php',
								method:'GET',
								success:function(res2){
									 $('#product_list').html(res2);
									 document.getElementById('avt').src = '';
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
			  function UpdateProduct(event, ID)
			  {
			  		document.getElementById('update_form').reset();
			  		var productName = event.target.getAttribute('data-product-name');
			  		var productDescription = event.target.getAttribute('data-product-description');
			  		var productPrice = event.target.getAttribute('data-product-price');
			  		var productCategory = event.target.getAttribute('data-product-category');
			  		var image_product_update = event.target.getAttribute('data-product-image');
			  		var detail_image_product_update = event.target.getAttribute('data-product-detail-image');
			  		var id_colors = event.target.getAttribute('data-product-id_colors');
			  		var id_materials = event.target.getAttribute('data-product-id_materials');
			  		var size = event.target.getAttribute('data-product-size');
			  		var material = event.target.getAttribute('data-product-material');
			  		$('#name_product_update').val(productName);
			  		$('#description_product_update').val(productDescription);
			  		$('#price_product_update').val(productPrice);
			  		$('#category_product_update').val(productCategory);
			  		$('#id_product_update').val(ID);
			  		$('#size_product_update').val(size);
			  		$('#material_product_update').val(material);
			  		var select_input = document.getElementById('color_product_update');
			  		var material_select_input = document.getElementById('material_product_update');
			  		id_colors.split(',').forEach(function(id){
			  			select_input.value = id.trim();
				  			// Tạo và kích hoạt sự kiện change
							var event = new Event("change");
							select_input.dispatchEvent(event);
			  		});
			  		id_materials.split(',').forEach(function(id){
						material_select_input.value = id.trim();
				  			// Tạo và kích hoạt sự kiện change
							var event = new Event("change");
							material_select_input.dispatchEvent(event);
			  		});
			  		base64Image_Array = [];

			  		base64Image_Array[base64Image_Array.length] = image_product_update;
			  		document.getElementById('image_product_update').nextElementSibling.src = image_product_update;
			  		$.ajax({
			  			url:"../../../mvc/core/ajax/Load-Detail-Product-Image.php",
			  			method:'POST',
			  			data:{ID_Product:ID},
			  			success:function(res){
			  				var obj = JSON.parse(res);
			  				var div = document.getElementById('detail_image_product_update').nextElementSibling;
			  				while (div.firstChild) {
							    div.removeChild(div.lastChild);
							  }
							  div.className = 'container';
							  var div2 = document.createElement('div');
							  div2.className='row';
			  				for (var i = 0; i < obj.length; i++) {
			  					var base64 = obj[i].Image;
			  					base64Image_Array[base64Image_Array.length] = base64;
			  					var box = document.createElement('div');
			  					box.className='col-md-auto';
									box.style = 'position:relative;';			  				

			  					var icon_delete = document.createElement('span');
			  					icon_delete.className ='close btn';
			  					icon_delete.innerHTML = ' &times;';
			  					icon_delete.style = 'position:absolute;background-color:#fff;color:red;right:10px;top:10px;padding: 0';
			  					icon_delete.addEventListener('click',DeleteImage);
			  					box.appendChild(icon_delete); 
			  					var img = document.createElement('img');
			  					img.src = base64;
			  					img.setAttribute('width','85px');
						  	  img.style.padding = '10px';	
			  					box.appendChild(img);

			  					div2.appendChild(box); 
			  					div.appendChild(div2); 
			  				}

			  			}
			  		})
			  }
			  document.getElementById('update_form').addEventListener('submit', function(event) {
				  var name_product = document.getElementById('name_product_update').value;
				  var description_product = document.getElementById('description_product_update').value;
				  var price_product = document.getElementById('price_product_update').value;
				  var category_product = document.getElementById('category_product_update').value;
				  var id_product = document.getElementById('id_product_update').value;
				  var color_list = document.getElementById('color_list_update').value;
				  var material_list = document.getElementById('material_list_update').value;
				  var size_product = document.getElementById('size_product_update').value;
				  var material_product = document.getElementById('material_product_update').value;
				  event.preventDefault();

				  var avt_image_input = document.getElementById('image_product_update');
				  var avt_image_file = avt_image_input.files[0];
				  var avt_image_name = avt_image_file ? avt_image_file.name : null;

				  var detail_image_files = lisDetailtFiles_Update;
				  var detail_image_names = [];
				  for (var i = 0; i < detail_image_files.length; i++) {
				    detail_image_names.push(detail_image_files[i].name);
				  }

				  var formData = new FormData();
				  if (avt_image_file) {
				    formData.append('image_product', avt_image_file, avt_image_name);
				  }
				  for (var i = 0; i < detail_image_files.length; i++) {
				    formData.append('detail_image_product[]', detail_image_files[i], detail_image_names[i]);
				  }
				  formData.append('name_product', name_product);
				  formData.append('description_product', description_product);
				  formData.append('price_product', price_product);
				  formData.append('category_product', category_product);
				  formData.append('id_product', id_product);
					formData.append('color_list', color_list);
					formData.append('material_list', material_list);
					formData.append('size_product', size_product);
					formData.append('material_product', material_product);
					
				  //Lấy ra các hình ảnh chi tiết đã có của sản phẩm mã người dùng vẫn giữ, chưa nhấn xoá
				  var containerDetailImage_Div = document.getElementById('detail_image_product_update').nextElementSibling.firstChild;
				  if(containerDetailImage_Div)
				  {
				  	var imgDetail = containerDetailImage_Div.getElementsByTagName('img');
					  var stillKeepDetailImage = [];
					  for (var i = 0; i < imgDetail.length; i++) {
					  	var img = imgDetail[i];
					  	if(!img.src.includes('data:image'))
					  	{
					    	 stillKeepDetailImage.push(img.src);
					  	}
					  }
					  formData.append('stillKeepDetailImage', JSON.stringify(stillKeepDetailImage));	
				  }
				  

				  Swal.fire({
				    title: "Đang cập nhật...",
				    text: "Please wait",
				    imageUrl: "../../../public/images/loading.gif",
				    showConfirmButton: false,
				    allowOutsideClick: false
				  });

				  $.ajax({
				    url: "../../../mvc/core/ajax/Update-Product.php",
				    method: "POST",
				    data: formData,
				    contentType: false,
				    processData: false,
				    success: function(res) {
				      Swal.close();
				      document.getElementById('update_form').reset();
				      document.getElementById('updateModal').getElementsByTagName('button')[0].click();
				      $('#thongbao').html(res);
				      lisDetailtFiles_Update = [];
				      $.ajax({
				        url: '../../../mvc/core/ajax/Load-Product.php',
				        method: 'GET',
				        success: function(res2) {
				          $('#product_list').html(res2);
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
					  		url:"../../../mvc/core/ajax/Delete-Product.php",
					  		method:'POST',
					  		data:{ID:ID},
					  		success:function(res) {
					  				Swal.close();
					  				$('#thongbao').html(res);
					  				$.ajax({
											url:'../../../mvc/core/ajax/Load-Product.php',
											method:'GET',
											success:function(res2){
												 $('#product_list').html(res2);
											}
										})
					  		}
					  	});
					  }
					})
			  }
</script>
<script>
	$('#table').DataTable({
   "ordering": false // false to disable sorting (or any other option)
  });
	id_input_file = 'image_product';
	window.addEventListener('paste', e => {
		//Check if data is a image
		if(e.clipboardData.files.length>0)
		{
			var fileInput = document.getElementById(id_input_file);
		  fileInput.files = e.clipboardData.files;
		  var event = new Event('change');
			fileInput.dispatchEvent(event);	
		}
		
	});
	document.getElementById('image_product').addEventListener("mouseover", function(){
		id_input_file = this.id;
	});
	document.getElementById('detail_image_product').addEventListener("mouseover", function(){
		id_input_file = this.id;
	});
	document.getElementById('image_product_update').addEventListener("mouseover", function(){
		id_input_file = this.id;
	});
	document.getElementById('detail_image_product_update').addEventListener("mouseover", function(){
		id_input_file = this.id;
	});
</script>