<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\AuthorizedIp;

class ManageIPs extends Component
{
    public $ip_address, $description, $editingIp;

    public function saveIp()
    {
        $this->validate([
            'ip_address' => 'required|ipv4', // Validate as a valid IPv4 address
            'description' => 'nullable|string|max:255',
        ]);

        if ($this->editingIp) {
            $this->editingIp->update([
                'ip_address' => $this->ip_address,
                'description' => $this->description,
            ]);
        } else {
            AuthorizedIp::create([
                'ip_address' => $this->ip_address,
                'description' => $this->description,
            ]);
        }

        $this->reset(['ip_address', 'description', 'editingIp']);
        session()->flash('success', 'IP Address saved successfully.');
    }

    public function editIp(AuthorizedIp $ip)
    {
        $this->editingIp = $ip;
        $this->ip_address = $ip->ip_address;
        $this->description = $ip->description;
    }

    public function deleteIp(AuthorizedIp $ip)
    {
        $ip->delete();
        session()->flash('success', 'IP Address deleted successfully.');
    }

  public function render()
{
    $ips = AuthorizedIp::all();
    return view('livewire.admin.settings.manage-i-ps', compact('ips'))
        ->layout('layouts.admindashboard');
}

}
