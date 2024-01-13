<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Permissao;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function AllUser()
     {
         $users=DB::table('users')
         ->join('model_has_permissions','model_has_permissions.model_id','=','users.id')
         ->join('permissions','permissions.id','=','model_has_permissions.permission_id')
         ->select('users.name','users.estado as estado','users.id as codigo','users.email','users.telefone as telefone','permissions.name as perfil')
         ->get();
 
       return  $users;
 
     }

    public function index()
    {
        $u=$this->AllUser();
        return view('user.consultar',['user'=>$u]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $p=Permissao::all();
        return view('user.index',['perfil'=>$p]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefone'=>$request->telefone,
            'estado'=>'ativo'
        ])->givePermissionTo($request->perfil);

    return view('user.index',['sms'=>'Utilizador registado com sucesso']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $u=User::findOrFail(addslashes($id));
        $p=Permissao::all();
      
        return view('user.editar',['u'=>$u, 'perfil'=>$p]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Auth::check())
       {
        $s=[
            'name'=> addslashes($request->name),
            'email'=>addslashes($request->email),
            'telefone'=> addslashes($request->telefone)
        ];
        $id=addslashes($request->id);
        $u=User::findOrFail($id);
        //retirar a antiga permissão do usuário
        $u->revokePermissionTo($u->getPermissionNames()->first());
       // adicionar uma nova permissão ao usuário
        $u->givePermissionTo($request->perfil);
       // $u=$u->syncPermissions([$u->getPermissionNames()->first(), $request->perfil]);
        $u->update($s);
        return view('user.consultar',['sms'=>'Utilizador alterado com sucesso','user'=>$this->AllUser()]);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pesquisar(Request $request)
    {
        $u=DB::table('users')
         ->join('model_has_permissions','model_has_permissions.model_id','=','users.id')
         ->join('permissions','permissions.id','=','model_has_permissions.permission_id')
         ->where('users.name','LIKE','%'.$request->nome.'%')
         ->select('users.name','users.estado as estado','users.id as codigo','users.email','permissions.name as perfil')
         ->get();

         if($u->count()>0)
         {
            return view ('user.consultar',['user'=>$u]);
         }

         return  view('user.consultar',['erro'=>'registo não encontrado']);
    }

    public function bloquear(Request $request)
    {
      
        $s=['estado'=>'bloqueado'];
        $id=addslashes($request->user_id);
        $u=User::findOrFail($id);

        $u->update($s);

        return view('user.consultar',['user'=>$this->AllUser(),'sms'=>'utilizador bloqueado com sucesso']);

    }


    public function desbloquear(Request $request)
    {
       // dd($request->user_id);
        $s=['estado'=>'ativo'];
        $id=addslashes($request->user_id);
        $u=User::findOrFail($id);
        $u->update($s);

        return view('user.consultar',['user'=>$this->AllUser(),'sms'=>'utilizador desbloqueado com sucesso']);
        
    }


    public function perfil (){
        $u=User::findOrFail(Auth::user()->id);
        return view('user.perfil',['user'=>$u]);
    }

    public function alterarFoto(Request $request)
    {

        if(Auth::check())
       {

        if($request->file('imagem')->isValid()){

            if($request->hasFile('imagem')!=null){

                $requestarquivo = $request->imagem;
                $extensao = $requestarquivo->extension();
                $nomearquivo = md5($requestarquivo->getClientOriginalName().strtotime("now")).".".$extensao;
                $request->imagem->move(public_path('img'),$nomearquivo);
               // $p->imagem = $nomearquivo;

                $s=['img'=>$nomearquivo];
                $id=addslashes($request->user_id);
                $u=User::findOrFail($id);
                $u->update($s);
                $file=User::findOrFail($id)->img;;

                return view('user.perfil',['sms'=>'Foto alterada com sucesso','file'=>$file]);
            }
        }
    }

    }


    public function alterarMinhaConta()
    {
       
        $u=User::findOrFail(Auth::user()->id);
        return view('user.alterarDados',['user'=>$u]);

    }


    public function MinhaContaUpdate(Request $request)
    {
      
        $s="";

        if(!is_null($request->password)){
         
            $s=[
                'name'=> addslashes($request->name),
                'telefone'=> addslashes($request->telefone),
                'password'=> Hash::make($request->password)
            ];
        }else{
            $s=[
                'name'=> addslashes($request->name),
                'telefone'=> addslashes($request->telefone)
            ];

        }

        $u=User::findOrFail(Auth::user()->id);
        $u->update($s); 
        return view('user.perfil',['sms'=>'Dados alterado com sucesso','user'=>$u]);
        
    }
}
