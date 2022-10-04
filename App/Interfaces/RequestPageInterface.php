<?php

namespace Interfaces;
interface RequestPageInterface
{
   function sendRequest(string $p_Url) : string;
}