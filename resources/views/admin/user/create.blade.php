 <form action="" enctype="multipart/form-data" data-url="{{ route('user.store') }}" id="addUserForm">
     <div class="row">
         <div class="col-md-12 mb-2">
             <label for="name">Name</label><span class="text-danger">*</span>
             <input type="text" name="name" id="name" class="form-control" value="" required>
             @error('name')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mb-2">
             <label for="email">Email</label><span class="text-danger">*</span>
             <input type="email" name="email" id="email" class="form-control" value="" required>
              @error('email')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mb-2">
             <label for="phone">Phone</label><span class="text-danger">*</span>
             <input type="text" name="phone" id="phone" class="form-control" pattern="[0-9]{10}" required>
              @error('phone')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mb-2">
             <label for="password">Password</label><span class="text-danger">*</span>
             <input type="password" name="password" id="password" class="form-control" required>
              @error('password')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mb-2">
             <label for="user_image">Image</label>
             <input type="file" name="image" id="image" class="form-control">
              @error('image')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mb-2">
             <label for="status">Status</label><span class="text-danger">*</span>
             <select name="status" id="status" class="form-control" required>
                 <option value="">Select Status</option>
                 <option value="active">Active</option>
                 <option value="inactive">Inactive</option>
             </select>
              @error('status')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mt-2">
             <button type="submit" class="btn btn-primary">Save</button>
         </div>
     </div>
 </form>
