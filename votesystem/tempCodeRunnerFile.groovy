import java.util.ArrayList;

public class PrimeFactors {

    public static ArrayList<Integer> findPrimeFactors(int n) {
        ArrayList<Integer> primeFactors = new ArrayList<>();

        //.constraint 1: If n is less than 2, return an empty list
        if (n < 2) {
            return primeFactors;
        }

        // Check divisibility by 2 first to handle even numbers
        while (n % 2 == 0) {
            if (!primeFactors.contains(2)) {
                primeFactors.add(2);
            }
            n /= 2;
        }

        // Check for odd numbers starting from 3
        for (int i = 3; i <= Math.sqrt(n); i += 2) {
            while (n % i == 0) {
                if (!primeFactors.contains(i)) {
                    primeFactors.add(i);
                }
                n /= i;
            }
        }

        // If n is a prime number greater than 2, add it
        if (n > 2) {
            primeFactors.add(n);
        }

        return primeFactors;
    }

    public static void main(String[] args) {
        int n = 315;  // Example input
        ArrayList<Integer> factors = findPrimeFactors(n);
        System.out.println(factors); // Output: [3, 5, 7]
    }
}