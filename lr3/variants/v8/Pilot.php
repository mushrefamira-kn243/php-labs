<?php
/**
 * Клас Pilot (Варіант 8)
 */
class Pilot {
    public string $name;
    public string $airline;
    public int $flightHours;

    /**
     * Конструктор зі значеннями за замовчуванням (для сумісності з task1/task2)
     */
    public function __construct(string $name = "", string $airline = "", int $flightHours = 0)
    {
        $this->name = $name;
        $this->airline = $airline;
        $this->flightHours = $flightHours;
    }

    /**
     * Метод __clone() викликається автоматично при використанні ключового слова clone
     */
    public function __clone(): void
    {
        $this->name = "Пілот";
        $this->airline = "";
        $this->flightHours = 0;
    }

    /**
     * Повертає структуровану інформацію про пілота
     */
    public function getInfo(): string
    {
        return "Пілот: {$this->name}, Авіакомпанія: {$this->airline}, Наліт: {$this->flightHours} год";
    }
}