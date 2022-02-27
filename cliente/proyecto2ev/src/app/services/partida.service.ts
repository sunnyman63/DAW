import { Injectable } from '@angular/core';
import { partida } from '../models/partida';

@Injectable({
  providedIn: 'root'
})
export class PartidaService {

  partida: partida = new partida();

  constructor() { }

  getPartida() {
    return this.partida;
  }

  getIniciada() {
    return this.partida.iniciada;
  }

  setIniciada(dato: boolean) {
    this.partida.iniciada = dato;
  }

  getJugadores() {
    return this.partida.jugadores;
  }

  setJugadores(dato: number) {
    this.partida.jugadores = dato;
  }

  getTablero() {
    return this.partida.tablero;
  }

  setTablero(dato: string) {
    this.partida.tablero = dato;
  }

  getTurno() {
    return this.partida.turno;
  }

  setTurno(dato: string) {
    this.partida.turno = dato;
  }

  getFinalizada() {
    return this.partida.finalizada;
  }

  set(dato: boolean) {
    this.partida.finalizada = dato;
  }

}
