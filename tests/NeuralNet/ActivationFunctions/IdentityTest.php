<?php

use MathPHP\LinearAlgebra\Matrix;
use Rubix\Engine\NeuralNet\ActivationFunctions\Identity;
use Rubix\Engine\NeuralNet\ActivationFunctions\ActivationFunction;
use PHPUnit\Framework\TestCase;

class IdentityTest extends TestCase
{
    protected $input;

    protected $activationFunction;

    public function setUp()
    {
        $this->input = new Matrix([[1.0], [-0.5]]);

        $this->activationFunction = new Identity(1.0);
    }

    public function test_build_activation_function()
    {
        $this->assertInstanceOf(Identity::class, $this->activationFunction);
        $this->assertInstanceOf(ActivationFunction::class, $this->activationFunction);
    }

    public function test_compute()
    {
        $activations = $this->activationFunction->compute($this->input);

        $this->assertEquals(1.0, $activations[0][0]);
        $this->assertEquals(-0.5, $activations[1][0]);
    }

    public function test_differentiate()
    {
        $activations = $this->activationFunction->compute($this->input);

        $slopes = $this->activationFunction->differentiate($this->input, $activations);

        $this->assertEquals(1.0, $slopes[0][0]);
        $this->assertEquals(1.0, $slopes[1][0]);
    }
}