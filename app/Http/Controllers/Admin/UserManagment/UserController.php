<?php

namespace App\Http\Controllers\Admin\UserManagment;

use App\User;
use Intervention\Image\ImageManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path(config('image.directory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user_managment.users.index', [
            'users' => User::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user_managment.users.create', [
           'user' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $file = $request->file('avatar');
        $path = $file->hashName('avatars'); // avatars/bf5db5c75904dac712aea27d45320403.jpeg
        $image = Image::make($file);
        $image->fit(250, 250, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put($path, (string) $image->encode());

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),  // Hash::make('$request->password')
        ]);

        return redirect()->route('admin.user_managment.user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //$img = Image::make('foo/bar/baz.jpg');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        return view('admin.user_managment.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
//        $manager = new ImageManager(array('driver' => 'imagick'));
//        $image = $manager->make('public/foo.jpg')->resize(300, 200);


        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                \Illuminate\Validation\Rule::unique('users')->ignore($user->id),  // for ignore current email
            ],
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user->name = $request['name'];
        $user->email = $request['email'];
        $request['password'] == null ?: $user->password = bcrypt($request['password']);  // Hash::make('$request->password')
        $user->save();

        return redirect()->route('admin.user_managment.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }


    private function handleRequest($request)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $successUploaded = $image->move($destination, $fileName);
            if ($successUploaded) {
                $width = config('image.thumbnail.width');
                $height = config('image.thumbnail.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                Image::make($destination . '/' . $fileName)
                    ->resize($width, $height)
                    ->save($destination . '/' . $thumbnail);
            }
            $data['image'] = $fileName;
        }
        return $data;
    }
}
