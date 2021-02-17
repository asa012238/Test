<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::select('name', 'age')
            ->orwhere('age', '30')
            // ->where('age','30')
            // ->orderby('age','DESC')
            ->groupby('age', 'name')
            ->get();

        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = $request->email;
        $name = $request->name;
        $age  = $request->age;
        $phone = $request->phone;

        if (!isset($email)) {
            return 'ไม่มีข้อมูล email';
        } else if (!isset($name)) {

            return 'ไม่มีข้อมูล name';
        } else if (!isset($age)) {
            return 'ไม่มีข้อมูล age';
        } else if (!isset($phone)) {
            return 'ไม่มีข้อมูล phone';
        }

        //check email
        $check = User::where('email', $email)->first();


        if ($check == null) {
            $user = new User();
            $user->email = $email;
            $user->name = $name;
            $user->age = $age;
            $user->phone = md5($phone);
            $user->save();
            return 'สำเร็จ';
        } else {
            return 'มีอีเมลล์นี้แล้วอยู่ในระบบ';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'code' => strval(200),
            'message' => 'เรียกดูสำเร็จ',
            'data' => $user,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->age = $request->age;
        $user->phone = md5($request->phone);
        $user->save();
        return 'สำเร็จ';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return 'สำเร็จ';
    }

    public function getuser()
    {
        echo "test";
    }
    public function login(Request $request)
    {
        $email = $request->email;
        $phone = $request->phone;

        $user = User::select('email', 'phone')
            ->where('email', $email)
            ->where('phone', md5($phone))
            ->get();

        return response()->json([
            'code' => strval(200),
            'message' => 'เรียกดูสำเร็จ',
            'data' => $user,
        ], 200);
    }
    public function Calculate(Request $request)
    {
        $name = $request->name;
        $point = $request->point;



        if ($point >= 50) {
            return response()->json([
                'code' => strval(200),
                'message' => 'เรียกดูสำเร็จ',
                'data' => 'คุณ' . $name . 'ผ่าน',
            ], 200);
        } elseif ($point == 49) {
            return response()->json([
                'code' => strval(200),
                'message' => 'เรียกดูสำเร็จ',
                'data' => 'คุณ' . $name . 'เกือบผ่าน',
            ], 200);
        } else {
            return response()->json([
                'code' => strval(200),
                'message' => 'เรียกดูสำเร็จ',
                'data' => 'คุณ' . $name . 'ไม่ผ่าน',
            ], 200);
        }
    }
    public function Grade(Request $request)
    {
        $grade = $request->grade;
        if ($grade >= 80) {
            return response()->json([
                'code' => strval(200),
                'message' => 'เรียกดูสำเร็จ',
                'data' => 'คุณได้เกรด A',
            ], 200);
        } elseif ($grade ==75) {
            return response()->json([
                'code' => strval(200),
                'message' => 'เรียกดูสำเร็จ',
                'data' => 'คุณได้เกรด B+',
            ], 200);
        }
        elseif ($grade >= 70) {
            return response()->json([
                'code' => strval(200),
                'message' => 'เรียกดูสำเร็จ',
                'data' => 'คุณได้เกรด B',
            ], 200);
        } elseif ($grade == 65) {
            return response()->json([
                'code' => strval(200),
                'message' => 'เรียกดูสำเร็จ',
                'data' => 'คุณได้เกรด C+',
            ], 200);
        }
        elseif ($grade >= 60) {
            return response()->json([
                'code' => strval(200),
                'message' => 'เรียกดูสำเร็จ',
                'data' => 'คุณได้เกรด C',
            ], 200);
        }
        elseif ($grade >= 50) {
            return response()->json([
                'code' => strval(200),
                'message' => 'เรียกดูสำเร็จ',
                'data' => 'คุณได้เกรด D',
            ], 200);
        } else {
            return response()->json([
                'code' => strval(200),
                'message' => 'เรียกดูสำเร็จ',
                'data' => 'คุณได้เกรด F',
            ], 200);
        }
    }
}
