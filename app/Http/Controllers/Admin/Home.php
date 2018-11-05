<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competition;
use App\Models\CompetitorCompetition;
use App\User;
use Illuminate\Http\Request;

class Home extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = [];
        $c = Competition::current()->first();
        if ($c){
            for ($r = $c->round; $r > 0; $r--) {
                $result_c = [];
                foreach ($c->competitors as $competitor) {
                    $points = [];
                    foreach ($competitor->points as $point) {
                        if ($point->round != $r)
                            continue;
                        $points[$point->user_id][$point->point_type] = $point->point * $point->kata->koef;
                    }
                    $competitor->list_point = $points;
                    $competitor->point = round($competitor->getPointRound($r), 2);
                    $result_c[$competitor->user->group->name][] = (object)[
                        'point' => round($competitor->getPointRound($r), 2),
                        'list_point' => $points,
                        'disabled_round' => $competitor->disabled_round,
                        'is_current' => $competitor->is_current,
                        'kata' => $competitor->kata->name ?? '-',
                        'id' => $competitor->id,
                        'fio' => $competitor->user->fio,
                    ];
                    //$competitor;
                }
                usort($result_c, function($a1, $a2){
                    $current = false;
                    foreach ($a2 as $item){
                        if ($item->is_current){
                            $current = true;
                            break;
                        }
                    }
                    return $current? 1: 0;
                });
                foreach ($result_c as &$item) {
                    usort($item, function ($a1, $a2) {
                        $res = ($a2->point ?? 0) - ($a1->point ?? 0);
                        return $res > 0 ? 1 : (($res < 0) ? -1 : 0);
                    });
                }

                $result[$r] = $result_c;
            }
        }

        return view('admin.home', [
            'list' => $result,
            'users' => User::where('is_admin', 0)->get(),
            'currentRound' => $c->round ?? 0
        ]);
    }

    public function next(int $id)
    {
        $c = CompetitorCompetition::current()->get()->first();
        if ($c) {
            $c->is_current = 0;
            $c->save();
        }

        $c = CompetitorCompetition::find($id);
        if ($c) {
            $c->competition->group_id = $c->user->group_id;
            $c->competition->save();
            $c->is_current = 1;
            $c->save();
        }

        return redirect('/admin');
    }

    public function disbaledround(Request $request)
    {
        $this->validate($request, [
            'exclude' => 'required',
        ]);

        $c = Competition::current()->first();
        foreach ($request->exclude as $id) {
            $cc = CompetitorCompetition::find($id);
            $cc->disabled_round = $c->round;
            $cc->save();
        }
        return redirect('/admin');
    }

    public function nextround()
    {
        $c = Competition::current()->first();
        $c->round++;
        $c->save();
        return redirect('/admin');
    }

    public function endround()
    {
        $c = Competition::current()->first();
        foreach ($c->competitors as $comp) {
            $comp->is_current = 0;
            $comp->kate_id = 0;
            $comp->save();
        }
        return redirect('/admin');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
