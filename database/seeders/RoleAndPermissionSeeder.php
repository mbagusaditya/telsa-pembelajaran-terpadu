<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'user.view',
            'user.create',
            'user.update',
            'user.delete',

            'student.view',
            'student.create',
            'student.update',
            'student.delete',

            'teacher.view',
            'teacher.create',
            'teacher.update',
            'teacher.delete',

            'major.view',
            'major.create',
            'major.update',
            'major.delete',

            'subject.view',
            'subject.create',
            'subject.update',
            'subject.delete',

            'class_group.view',
            'class_group.create',
            'class_group.update',
            'class_group.delete',

            'course_offering.view',
            'course_offering.create',
            'course_offering.update',
            'course_offering.delete',

            'schedule.view',
            'schedule.create',
            'schedule.update',
            'schedule.delete',

            'material.view',
            'material.create',
            'material.update',
            'material.delete',

            'assignment.view',
            'assignment.create',
            'assignment.update',
            'assignment.delete',

            'submission.view',
            'submission.create',
            'submission.update',
            'submission.delete',

            'submission_grade.view',
            'submission_grade.create',
            'submission_grade.update',
            'submission_grade.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'student' => [
                'student.view',

                'major.view',
                'subject.view',
                'class_group.view',
                'course_offering.view',
                'schedule.view',

                'material.view',

                'assignment.view',

                'submission.view',
                'submission.create',
                'submission.update',

                'submission_grade.view',
            ],

            'teacher' => [
                'student.view',
                'teacher.view',

                'major.view',
                'subject.view',
                'class_group.view',
                'course_offering.view',
                'schedule.view',

                'material.view',
                'material.create',
                'material.update',
                'material.delete',

                'assignment.view',
                'assignment.create',
                'assignment.update',
                'assignment.delete',

                'submission.view',

                'submission_grade.view',
                'submission_grade.create',
                'submission_grade.update',
            ],

            'admin' => [
                'user.view',
                'user.create',
                'user.update',
                'user.delete',

                'student.view',
                'student.create',
                'student.update',
                'student.delete',

                'teacher.view',
                'teacher.create',
                'teacher.update',
                'teacher.delete',

                'major.view',
                'major.create',
                'major.update',
                'major.delete',

                'subject.view',
                'subject.create',
                'subject.update',
                'subject.delete',

                'class_group.view',
                'class_group.create',
                'class_group.update',
                'class_group.delete',

                'course_offering.view',
                'course_offering.create',
                'course_offering.update',
                'course_offering.delete',

                'schedule.view',
                'schedule.create',
                'schedule.update',
                'schedule.delete',

                'material.view',
                'material.create',
                'material.update',
                'material.delete',

                'assignment.view',
                'assignment.create',
                'assignment.update',
                'assignment.delete',

                'submission.view',
                'submission.create',
                'submission.update',
                'submission.delete',

                'submission_grade.view',
                'submission_grade.create',
                'submission_grade.update',
                'submission_grade.delete',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::findOrCreate($roleName, 'web');

            $role->syncPermissions($rolePermissions);
        }

        // $role = Role::create(['name' => 'super-admin']);
        // $role->givePermissionTo(Permission::all());
    }
}
