 <form action="" enctype="multipart/form-data" data-url="{{ route('user.update',$user->id) }}" id="updateUserForm">
         <div class="col-md-12 mb-2">
             <label for="name">Name</label>
             <input type="hidden" name="id" id="id" value="{{ $user->id }}">
             <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" value="" required>
             @error('name')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mb-2">
             <label for="email">Email</label>
             <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" value="" required>
              @error('email')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mb-2">
             <label for="phone">Phone</label>
             <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control" pattern="[0-9]{10}" required>
              @error('phone')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mb-2">
             <label for="password">Password</label>
             <input type="password" name="password" id="password" class="form-control" required>
              @error('password')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mb-2">
             <label for="user_image">Image</label>
             <input type="file" name="image" id="image" value="{{ $user->image }}" class="form-control">
              @error('image')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mb-2">
             <label for="status">Status</label>
             <select name="status" id="status" class="form-control" required>
                 <option value="">Select Status</option>
                 <option value="active" {{ $user->status=="active"?'selected':'' }}>Active</option>
                 <option value="inactive" {{ $user->status=="inactive"?'selected':'' }}>Inactive</option>
             </select>
              @error('status')
                 <div class="text-danger">{{ $message }}</div>
             @enderror
         </div>
         <div class="col-md-12 mt-2">
             <button type="submit" class="btn btn-primary">Update</button>
         </div>
     </div>
 </form>
