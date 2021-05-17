@extends('layouts.app')
@section('content')
    {{-- <div>
        <b-nav pills>
            <b-nav-item ><router-link to="/">Home</router-link></b-nav-item>
            <b-nav-item ><router-link to="/Dashboard">Dashboard</router-link></b-nav-item>
            <b-nav-item ><router-link to="/Login">Login</router-link></b-nav-item>
            <b-nav-item ><router-link to="/Register">Register</router-link></b-nav-item>    
        </b-nav>
    </div> --}} 
        <router-view></router-view>
    
@endsection