<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $role1=Role::create(['name'=>'admin']);
        $role2=role::create(['name'=>'preceptor']);
        $role3=role::create(['name'=>'profesor']);
        $role4=role::create(['name'=>'alumno']);
        $role5=Role::create(['name' =>'cooperadora']);

        Permission::create(['name' => 'admin.anuncio.index', 'description' => 'Ver lista de anuncios personales'])->syncRoles([$role1, $role2, $role3]); //si quieres asignar a varios roles
        Permission::create(['name' => 'admin.anuncio.create', 'description' => 'Crear un anuncio'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.anuncio.edit', 'description' => 'Editar un anuncio'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.anuncio.destroy', 'description' => 'Eliminar un anuncio'])->syncRoles([$role1, $role2, $role3]);

        //admin
        Permission::create(['name' => 'admin.configuracion.index', 'description' => 'Ver y modificar configuracion'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.mesas.create', 'description' => 'Ver y modificar las mesas de examenes'])->syncRoles([$role1]);
        
        Permission::create(['name' => 'admin.roles.index', 'description' => 'Ver lista de roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.create', 'description' => 'Crear un rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.edit', 'description' => 'Editar un rol'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.destroy', 'description' => 'Eliminar un rol'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.cursos.index', 'description' => 'Ver lista de cursos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.cursos.create', 'description' => 'Crear un curso'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.cursos.edit', 'description' => 'Editar un curso'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.cursos.destroy', 'description' => 'Elimina un curso'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver listado de usuarios'])->syncRoles($role1); //si quieres asignar a un solo rol
        Permission::create(['name' => 'admin.users.show', 'description' => 'Ver informacion de un usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Editar un usuario'])->syncRoles($role1);
        Permission::create(['name' => 'admin.users.destroy', 'description' => 'Elimina un usuario'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.materias.index', 'description' => 'Ver listado de materias'])->syncRoles($role1);
        Permission::create(['name' => 'admin.materias.show', 'description' => 'Ver informacion de una materia'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.materias.edit', 'description' => 'Editar una materia'])->syncRoles($role1);
        Permission::create(['name' => 'admin.materias.destroy', 'description' => 'Elimina una materia'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.users.create', 'description' => 'Registrar un Nuevo Usuario'])->syncRoles([$role1]);

        //preceptor
        Permission::create(['name' => 'prece.curso.index', 'description' => 'Ver lista de sus cursos asignados'])->syncRoles([$role2, $role3]);
        Permission::create(['name' => 'prece.asistencia.index', 'description' => 'Ver planilla de asistencia'])->syncRoles([$role2]);
        Permission::create(['name' => 'prece.asistencia.create', 'description' => 'Ver planilla de asistencia completa'])->syncRoles([$role2]);

        Permission::create(['name' => 'anuncio.curso', 'description' => 'Seleccionar para que curso es el anuncio'])->syncRoles([$role2, $role3]);
        Permission::create(['name' => 'admin.horario.index', 'description' => 'Ver horario'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.horario.edit', 'description' => 'Editar horarios'])->syncRoles([$role1, $role2]);
       
        //profesor
        Permission::create(['name' => 'profe.boletin', 'description' => 'Editar boletin del alumno'])->syncRoles([$role2, $role3]);

        //alumnos
        Permission::create(['name' => 'alumno.boletin', 'description' => 'Ver boletin del alumno'])->syncRoles($role4);
        Permission::create(['name' => 'alumno.datos.index', 'description' => 'Ver datos del alumno'])->syncRoles($role4);
        Permission::create(['name' => 'alumno.datos.create', 'description' => 'Crear formulario con datos del alumno'])->syncRoles($role4);
        Permission::create(['name' => 'alumno.datos.edit', 'description' => 'Editar los datos del alumno'])->syncRoles($role4);
        Permission::create(['name' => 'alumno.certificado', 'description' => 'Pedir certificado de alumno regular'])->syncRoles($role4);

        //cooperadora
        Permission::create(['name' => 'cooperadora.pagos.index', 'description' => 'Ver los pagos del alumno'])->syncRoles($role5);
        Permission::create(['name' => 'cooperadora.pagos.approve', 'description' => 'Aprobar los pagos de los alumnos'])->syncRoles($role5);
    }
}
