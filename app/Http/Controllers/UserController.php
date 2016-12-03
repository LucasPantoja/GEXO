<?php

namespace gexo\Http\Controllers;

use Request;
use Session;
use Auth;
use gexo\Question;
use gexo\Invite;
use gexo\Exercises;
use gexo\Points_Fields;
use gexo\User;
use gexo\Field;
use gexo\SocialAccount;
use gexo\Http\Requests\InviteRequest;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('UserVerify');
    }

    public function Home(){
        $invites = Invite::where('from_user_id', Auth::user()->id)->get();
        $facebook = SocialAccount::where('user_id', Auth::user()->id)->exists();
    	$questions = Question::where('user_id', Auth::user()->id)->get();
        $aptidoes = Points_Fields::where('user_id', Auth::user()->id)->orderBy('points', 'desc')->take(3)->get();
        $exercises = Exercises::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    	return view('user.home')->with('questions', $questions)
                                ->with('facebook', $facebook)
                                ->with('invites', $invites)
                                ->with('aptidoes', $aptidoes)
                                ->with('exercises', $exercises);
    }

    public function Visitor($id){
    	$visitor = User::find($id);
    	$questions = Question::where('user_id', $visitor->id)->get();
        $aptidoes = Points_Fields::where('user_id', $visitor->id)->orderBy('points', 'desc')->take(3)->get();
        $exercises = Exercises::where('user_id', $visitor->id)->orderBy('created_at', 'desc')->get();
    	return view('user.visitor')->with('visitor', $visitor)
                                   ->with('questions', $questions)
    							   ->with('aptidoes', $aptidoes)
                                   ->with('exercises', $exercises);
    }

    public function Rank(){
        $fields = Field::orderBy('title', 'asc')->get();
        $users = User::orderBy('total_points', 'desc')->get();
        $points_fields = Points_Fields::orderBy('points', 'desc')->get();
        $array = Points_Fields::pluck('field_id')->toArray();
        return view('user.rank')->with('users', $users)
                                ->with('fields', $fields)
                                ->with('points_fields', $points_fields)
                                ->with('array', $array);
    }

    public function PointingLab(){
        $field_id = Session::get('field_id');
        $answers = Request::input('answer');
        $levels = Request::input('question_level');
        $quantity = Session::get('quantity');
        $points = 0;
        $userpoints = Auth::user()->total_points;
        $point_field = Points_Fields::firstOrCreate(['user_id' => Auth::user()->id, 'field_id' => $field_id]);
        $field_point = 0 + $point_field->points;

        for ($i=0; $i < $quantity; $i++) { 
            if ($levels[$i] == 0 && $answers[$i] == 1) {
                $points = $points + 1;
                $field_point = $field_point + 1;
            }elseif($levels[$i] == 1 && $answers[$i] == 1){
                $points = $points + 3;
                $field_point = $field_point + 3;
            }elseif($levels[$i] == 2 && $answers[$i] == 1){
                $points = $points + 5;
                $field_point = $field_point + 5;
            }
        }

        Session::put('answers', $answers);
        Session::put('points', $points);

        Auth::user()->update(['total_points' => $userpoints + $points]);
        $point_field->update(['points' => $field_point]);

        return redirect()->action("LabController@Result");
    }

    public function Upgrade(){
        return view('user.upgrade');
    }

    public function UpAccount(InviteRequest $request){
        $invite = Invite::where('key', $request->key)
                               ->where('used', false)
                               ->exists();

        if ($invite != false) {
            $invite1 = new Invite(['from_user_id' => Auth::user()->id, 'key' => str_random(30)]);
            $invite2 = new Invite(['from_user_id' => Auth::user()->id, 'key' => str_random(30)]);
            $invite3 = new Invite(['from_user_id' => Auth::user()->id, 'key' => str_random(30)]);

            $invite1->save();
            $invite2->save();
            $invite3->save();

            Invite::where('key', $request->key)->update(['to_user_id' => Auth::user()->id]);
            Invite::where('key', $request->key)->update(['used' => true]);
            Auth::user()->update(['role' => true]);
            Request::session()->flash('Upgrade', 'Sua Conta foi atualizada');
            return redirect()->action('UserController@Home');

        }else{
            Request::session()->flash('FailUpgrade', 'Chave usada não é válida');
            return redirect()->action('UserController@Upgrade');
        }

        
    }

    public function RetrievingPoints($user_id, $field_id){
        $points_fields = Points_Fields::where('user_id', $user_id)
                                        ->where('field_id', $field_id)->get();
        echo $points_fields->points;
        return null;
    }


}
