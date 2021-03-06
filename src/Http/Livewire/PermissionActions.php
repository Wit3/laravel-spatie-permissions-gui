<?php

namespace Wit3\LaravelSpatiePermissionsGui\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Models\Role;

class PermissionActions extends Component
{
    public $useActions;
    public $actions;
    public $permission;
    public $separator;
    public $name;

    public function mount($permission)
    {
        $this->permission = $permission;
        $this->name = $permission;
        $this->useActions = config("spatie-permissions-gui.use_common_actions", false);
        $this->actions = config("spatie-permissions-gui.actions", []);
        $this->separator = config("spatie-permissions-gui.permission_action_separator", "-");

        if (count($this->actions) === 0) {
            $this->useActions = false;
        }
    }

    private function getPermissions()
    {
        $permissions = [];

        if ($this->useActions) {
            $actions = array_keys($this->actions);
            foreach ($actions as $action) {
                $permissions[] = $this->permission . $this->separator . $action;
            }
        } else {
            $permissions[] = $this->permission;
        }

        return $permissions;
    }

    public function allowAll()
    {
        $this->resetErrorBag();
        $this->resetvalidation();

        foreach (Role::all() as $role) {
            $role->givePermissionTo($this->getPermissions());
        }

        $this->emit("refreshMappings");
    }

    public function disallowAll()
    {
        $this->resetErrorBag();
        $this->resetvalidation();

        foreach (Role::all() as $role) {
            $role->revokePermissionTo($this->getPermissions());
        }

        $this->emit("refreshMappings");
    }

    public function updatePermission()
    {
        $oldname = $this->permission;
        $newname = $this->name;

        $this->resetErrorBag();
        $this->resetValidation();

        $firstAction = $this->useActions ? collect($this->actions)->keys()->first() : "";
        $newnameSuffixed = $this->useActions ? $newname . $this->separator . $firstAction : $newname;
        $oldnameSuffixed = $this->useActions ? $oldname . $this->separator . $firstAction : $oldname;

        $referencePermission = SpatiePermission::where("name", "=", $oldnameSuffixed)->first();

        if (! $referencePermission) {
            return;
        }

        Validator::make([
            "oldname" => $newname,
            "oldnameSuffixed" => $newnameSuffixed,
        ], [
            'oldname' => "required|min:3",
            'oldnameSuffixed' => [
                'required', 'min:3',
                Rule::unique(config("permission.table_names.permissions"), "name")->ignore($referencePermission->id),
            ],
        ], [], [
            'oldname' => 'permission name',
            'oldnameSuffixed' => 'permission name',
        ])->validate();

        if ($this->useActions) {
            $actions = array_keys($this->actions);
            foreach ($actions as $action) {
                $perm = SpatiePermission::where("name", "=", $oldname . $this->separator . $action)->first();
                if ($perm instanceof SpatiePermission) {
                    $perm->name = $newname . $this->separator . $action;
                    $perm->save();
                }
            }
        } else {
            $perm = SpatiePermission::where("name", "=", $oldname)->first();
            if ($perm instanceof SpatiePermission) {
                $perm->name = $newname;
                $perm->save();
            }
        }
        $this->emit("refreshMappings");
    }

    public function deletePermission()
    {
        $permissions = $this->getPermissions();
        foreach ($permissions as $permission) {
            $perm = SpatiePermission::where("name", "=", $permission)->first();
            if ($perm instanceof SpatiePermission) {
                $perm->delete();
            }
        }
        $this->emit("refreshMappings");
    }

    public function render()
    {
        return view(
            "spatie-permissions-gui::livewire." . config("spatie-permissions-gui.theme") . ".partials.permission-actions",
            ["permission" => $this->permission]
        );
    }
}
