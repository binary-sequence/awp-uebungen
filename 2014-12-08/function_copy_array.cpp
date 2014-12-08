#include <iostream>
#include <stdio.h>
#define LENGTH_ACZEICHEN 4
#define LENGTH_AIFELD 3

using namespace std;

void fill(char *pac, int *pai);
void showIntArray(int *pai, int paiLenght);

int main() {
	char acZeichen[LENGTH_ACZEICHEN] = "WER";
	int aiFeld[LENGTH_AIFELD] = {0};

	fill(acZeichen, aiFeld);

	printf("acZeichen: %s \n", acZeichen);
	cout << "aiFeld: ";
	showIntArray(aiFeld, LENGTH_AIFELD);
	cout << endl;
}

void fill(char *pac, int *pai) {
	for (int i = 0; *(pac + i) != '\0'; i++) {
		*(pai + i) = *(pac + i);
	}
}

void showIntArray(int *pai, int paiLenght) {
	for(int i = 0; i < paiLenght; i++) {
		cout << pai[i] << " ";
	}
}
