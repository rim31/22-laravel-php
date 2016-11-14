/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   lc.c                                               :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: rims <rims@student.42.fr>                  +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2016/07/19 13:22:05 by oseng             #+#    #+#             */
/*   Updated: 2016/11/13 17:23:13 by rims             ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <stdio.h>
#include <stdlib.h>


typedef struct 		s_list {
	int 			data;
	struct s_list 	*next;
}					t_list;

t_list *new_maillon(int data)/*fonction aui creer un maillon*/
{
	t_list *test;
	test = (t_list *)malloc(sizeof(t_list));
	test->data = data;
	test->next = NULL;
	return(test);
}

void	display(t_list *liste)
{
	t_list *tmp;

	tmp = liste;
	while(tmp)
	{
		printf(" => %d ", tmp->data);
		tmp = tmp->next;
	}
	printf("\n");
}

void	insert(t_list **liste, t_list *maillon)/*insertion d'un maillon dans une liste, au debut*/
{
	if (*liste == NULL)
		*liste = maillon;
	else
	{
		maillon->next = *liste;/* le maillon pointe vers la liste*/
		*liste = maillon;/* le 1er eleemt de la liste est le nouveau maillon*/
	}
}

t_list *creat(int nb)
{
	t_list *liste;
	int i;

	i = 0;
	while (i < nb)
	{
		insert(&liste, new_maillon(i));
		i++;
	}
	return (liste);
}

int main(int ac, char **av)
{
	t_list *toto;

	toto = NULL;
	if (ac == 2)
	{
		display(creat(atoi(av[1])));
	}
	return(0);
}

// int main(int ac, char **av)
// {
// 	t_list *toto;
//
// 	toto = NULL;
// 	insert(&toto, new_maillon(42));
// 	insert(&toto, new_maillon(1));
// 	insert(&toto, new_maillon(2));
// 	insert(&toto, new_maillon(2));
// 	insert(&toto, new_maillon(46));
// 	insert(&toto, new_maillon(16));
// 	insert(&toto, new_maillon(28));
// 	insert(&toto, new_maillon(62));
// 	display(toto);
// 	return(0);
// }


// int main(int ac, char **av)
// {
// 	t_list *toto;
//
// 	toto = NULL;
// 	toto = new_maillon(2);
// 	printf("%d \n", toto->data);
// 	return(0);
// }
