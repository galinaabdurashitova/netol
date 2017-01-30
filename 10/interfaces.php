<?php
interface Pencil
{
	public draw();
	public sharpen();
	public break();
	public getColor();
	public getHB();
}

interface Wine
{
	public buy($quantity);
	public delivery($quantity);
	public changePrice ($newPrice);
	public countBottles();
	public getInfo();
}

interface Paper
{
	public fold();
	public draw($content);
	public cut($size);
	public cutFigure($form);
	public getInfo();
}

interface House
{
	public newResidents($amount);
	public removeResidents($amount);
	public howOld($yearNow);
	public flatsOnFloor();
	public getInfo();
}

interface Book
{
	public getInfo();
	public read($pages);
	public restart();
	public pagesTillEnd();
}
