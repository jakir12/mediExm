<?php

namespace Bulkly\Http\Controllers;

use Illuminate\Http\Request;
use Bulkly\BufferView;
use Session;
use DB;

class BufferCntroller extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function viewBuffer() {

        $buffPosting = DB::table('buffer_postings')
                ->leftJoin('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
                ->leftJoin('social_accounts', 'buffer_postings.account_id', '=', 'social_accounts.id')
                ->select('buffer_postings.id', 'buffer_postings.post_text', 'buffer_postings.sent_at', 'social_post_groups.name', 'social_post_groups.type', 'social_accounts.name', 'social_accounts.avatar')
                ->paginate(50);

        $groups = DB::table("social_post_groups")->get();

//        echo "<pre>";
//        print_r($buffPosting);
//        exit();
        return view('buffer_post.buffer_posting', ['buffer_postings' => $buffPosting, 'social_groups' => $groups]);
    }

    public function search_recent_post(Request $request) {

        $post_text = $request->input('post_text');
        $sent_at = $request->input('sent_at');
        $group_id = $request->input('group_id');

        if ($group_id == '0' && $sent_at == "" && $post_text = "") {
            $buffPosting = DB::table('buffer_postings')
                    ->leftJoin('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
                    ->leftJoin('social_accounts', 'buffer_postings.account_id', '=', 'social_accounts.id')
                    ->select('buffer_postings.id', 'buffer_postings.post_text', 'buffer_postings.sent_at', 'social_post_groups.name', 'social_post_groups.type', 'social_accounts.name', 'social_accounts.avatar')
                    ->paginate(50);
            $groups = DB::table("social_post_groups")->get();
        } else {

            if ($post_text != '') {

                $buffPosting = DB::table('buffer_postings')
                        ->leftJoin('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
                        ->leftJoin('social_accounts', 'buffer_postings.account_id', '=', 'social_accounts.id')
                        ->select('buffer_postings.id', 'buffer_postings.post_text', 'buffer_postings.sent_at', 'social_post_groups.name', 'social_post_groups.type', 'social_accounts.name', 'social_accounts.avatar')
                        ->where('buffer_postings.post_text', 'like', '%' . $post_text . '%')
                        ->paginate(50);

                $groups = DB::table("social_post_groups")->get();
            } else if ($sent_at != '') {

                $buffPosting = DB::table('buffer_postings')
                ->leftJoin('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
                ->leftJoin('social_accounts', 'buffer_postings.account_id', '=', 'social_accounts.id')
                ->select('buffer_postings.id', 'buffer_postings.post_text', 'buffer_postings.sent_at', 'social_post_groups.name', 'social_post_groups.type', 'social_accounts.name', 'social_accounts.avatar')
                ->where(DB::raw('CAST(buffer_postings.sent_at as date)'), '=', $sent_at)
                ->paginate(50);
                

                $groups = DB::table("social_post_groups")->get();
            } else if ($group_id != '') {

                $buffPosting = DB::table('buffer_postings')
                        ->leftJoin('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
                        ->leftJoin('social_accounts', 'buffer_postings.account_id', '=', 'social_accounts.id')
                        ->select('buffer_postings.id', 'buffer_postings.post_text', 'buffer_postings.sent_at', 'social_post_groups.name', 'social_post_groups.type', 'social_accounts.name', 'social_accounts.avatar')
                        ->where('buffer_postings.group_id', '=', $group_id)
                        ->paginate(50);
                $groups = DB::table("social_post_groups")->get();
            } else if ($post_text != '' && $sent_at != '') {

                $buffPosting = DB::table('buffer_postings')
                        ->leftJoin('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
                        ->leftJoin('social_accounts', 'buffer_postings.account_id', '=', 'social_accounts.id')
                        ->select('buffer_postings.id', 'buffer_postings.post_text', 'buffer_postings.sent_at', 'social_post_groups.name', 'social_post_groups.type', 'social_accounts.name', 'social_accounts.avatar')
                        ->where('buffer_postings.post_text', 'like', '%' . $post_text . '%')
                        ->where(DB::raw('CAST(buffer_postings.sent_at as date)'), '=', $sent_at)
                        ->paginate(50);
                $groups = DB::table("social_post_groups")->get();
            } else if ($sent_at != '' && $group_id != '') {

                $buffPosting = DB::table('buffer_postings')
                        ->leftJoin('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
                        ->leftJoin('social_accounts', 'buffer_postings.account_id', '=', 'social_accounts.id')
                        ->select('buffer_postings.id', 'buffer_postings.post_text', 'buffer_postings.sent_at', 'social_post_groups.name', 'social_post_groups.type', 'social_accounts.name', 'social_accounts.avatar')
                        ->where(DB::raw('CAST(buffer_postings.sent_at as date)'), '=', $sent_at)
                        ->where('buffer_postings.group_id', '=', $group_id)
                        ->paginate(50);
                $groups = DB::table("social_post_groups")->get();
            } else if ($post_text != '' && $group_id != '') {

                $buffPosting = DB::table('buffer_postings')
                        ->leftJoin('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
                        ->leftJoin('social_accounts', 'buffer_postings.account_id', '=', 'social_accounts.id')
                        ->select('buffer_postings.id', 'buffer_postings.post_text', 'buffer_postings.sent_at', 'social_post_groups.name', 'social_post_groups.type', 'social_accounts.name', 'social_accounts.avatar')
                        ->where('buffer_postings.post_text', 'like', '%' . $post_text . '%')
                        ->where('buffer_postings.group_id', '=', $group_id)
                        ->paginate(50);
                $groups = DB::table("social_post_groups")->get();
            } else {
                $buffPosting = DB::table('buffer_postings')
                        ->leftJoin('social_post_groups', 'buffer_postings.group_id', '=', 'social_post_groups.id')
                        ->leftJoin('social_accounts', 'buffer_postings.account_id', '=', 'social_accounts.id')
                        ->select('buffer_postings.id', 'buffer_postings.post_text', 'buffer_postings.sent_at', 'social_post_groups.name', 'social_post_groups.type', 'social_accounts.name', 'social_accounts.avatar')
                        ->where('buffer_postings.post_text', 'like', '%' . $post_text . '%')
                        ->where('buffer_postings.group_id', '=', $group_id)
                        ->where(DB::raw('CAST(buffer_postings.sent_at as date)'), '=', $sent_at)
                        ->paginate(50);

                $groups = DB::table("social_post_groups")->get();
            }
        }

        return view('buffer_post.buffer_posting', ['buffer_postings' => $buffPosting, 'social_groups' => $groups]);
    }

}
