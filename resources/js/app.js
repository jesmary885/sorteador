import './bootstrap';

import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
window.Livewire = Livewire; // Hacerlo disponible globalmente
Livewire.start();