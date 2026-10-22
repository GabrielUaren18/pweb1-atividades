# Questão 07: Encapsulamento

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `conta.php` | A conta da aula. Você encapsula |
| `teste-protecao.php` | Fornecido: três tentativas de burlar a classe |

## 1. Análise do código

**1.1 Cole a sua classe e explique: quais atributos e métodos são `private`, quais são `public` e por quê.**

```php
class ContaBancaria
{
    private string $titular;
    private string $numero;
    private float $saldo = 0.0;
    private array $extrato = [];

    public function __construct(string $titular, string $numero)
    {
        $this->titular = $titular;
        $this->numero = $numero;
    }

    public function getTitular(): string
    {
        return $this->titular;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function getExtrato(): array
    {
        return $this->extrato;
    }

    private function registrar(string $operacao, float $valor): void
    {
        $this->extrato[] = [
            "operacao" => $operacao,
            "valor" => $valor
        ];
    }

    public function depositar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception("Depósito inválido.");
        }

        $this->saldo += $valor;
        $this->registrar("Depósito", $valor);
    }

    public function sacar(float $valor): void
    {
        if ($valor <= 0) {
            throw new Exception("Saque inválido.");
        }

        if ($valor > $this->saldo) {
            throw new Exception("Saldo insuficiente.");
        }

        $this->saldo -= $valor;
        $this->registrar("Saque", $valor);
    }

    public function apresentarDados(): void
    {
        echo "Titular: {$this->titular}\n";
        echo "Conta: {$this->numero}\n";
        echo 'Saldo: R$ ' . number_format($this->getSaldo(), 2, ',', '.') . "\n";
    }
}
```

Os atributos `$titular`, `$numero`, `$saldo` e `$extrato` são `private` para ninguém conseguir alterar os dados diretamente de fora da classe.

O método `registrar()` também é `private`, porque só a própria classe deve registrar as movimentações.

Já o construtor, os métodos `getTitular()`, `getSaldo()`, `getExtrato()`, `depositar()`, `sacar()` e `apresentarDados()` são `public`, porque precisam ser usados fora da classe.

**1.2 Explique o método privado `registrar()` e como o extrato é montado.**

O método `registrar()` guarda as movimentações da conta em um array chamado `$extrato`. Quando um depósito ou saque é realizado com sucesso, ele registra o tipo da operação e o valor. Depois, o método `getExtrato()` permite consultar essas movimentações.

## 2. Saídas do terminal

**2.1 Saída com `$conta->saldo = -300;` na versão original (item 1)**

```text
Titular: João
Conta: 12345
Saldo: R$ -300,00
```

**Explicação:**

Na versão original, o saldo era público. Por isso, consegui colocar um valor negativo diretamente, sem nenhuma verificação. Isso mostra que a conta não estava protegida.

**2.2 Saída da versão encapsulada:** `php q07-encapsulamento/conta.php`

```text
Recusado: Saldo insuficiente.
Recusado: Depósito inválido.
Extrato de João:
- Depósito: R$ 1.000,00
- Saque: R$ 250,00
Saldo final: R$ 750,00
```

**Explicação:**

Depositei R$ 1.000,00 e saquei R$ 250,00. Depois tentei sacar R$ 5.000,00 e depositar R$ -10,00, mas as duas operações foram recusadas. No final, o saldo continuou em R$ 750,00 e o extrato mostrou apenas as operações que deram certo.

**2.3 Tentativa 1: `$conta->saldo = -300;`:** `php q07-encapsulamento/teste-protecao.php`

```text
--- tentativas por fora ---
PHP Fatal error: Uncaught Error: Cannot access private property ContaBancaria::$saldo
```

**Explicação:**

Tentei alterar o saldo diretamente, mas o PHP bloqueou porque agora o atributo é `private`.

**2.4 Tentativa 2: `$conta->registrar(...)`**

```text
--- tentativas por fora ---
PHP Fatal error: Uncaught Error: Call to private method ContaBancaria::registrar() from global scope
```

**Explicação:**

Tentei registrar uma movimentação diretamente, mas não consegui porque o método `registrar()` é privado. Ele só pode ser chamado dentro da classe.

**2.5 Tentativa 3: `echo $conta->saldo;`**

```text
--- tentativas por fora ---
PHP Fatal error: Uncaught Error: Cannot access private property ContaBancaria::$saldo
```

**Explicação:**

Tentei consultar o saldo diretamente, mas o PHP não permitiu. Agora preciso usar o método `getSaldo()` para consultar esse valor.

## 3. Perguntas

**a) Por que a conta não tem um método `setSaldo()`?**

Porque, se tivesse esse método permitindo colocar qualquer valor, alguém poderia mudar o saldo sem fazer um depósito ou saque. O certo é alterar o saldo apenas pelos métodos `depositar()` e `sacar()`, que verificam as regras.

**b) Qual a diferença entre a versão original (`echo` + `return`) e a nova (`throw`) quando uma operação é inválida?**

Na versão original, o `echo` mostrava uma mensagem e o `return` encerrava o método. Na nova versão, o `throw` lança uma exceção, que pode ser tratada com `try/catch`. Assim, fica mais fácil controlar os erros.

**c) O que acontece com o saldo quando um saque é recusado? Use a saída 2.2.**

O saldo não muda. Na saída 2.2, tentei sacar R$ 5.000,00, mas não tinha dinheiro suficiente. O saque foi recusado e o saldo continuou em R$ 750,00.