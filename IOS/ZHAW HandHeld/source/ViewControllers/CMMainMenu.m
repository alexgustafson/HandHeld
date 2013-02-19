//
//  CMMainMenu.m
//  ZHAW HandHeld
//
//  Created by Alex Gustafson on 2/18/13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "CMMainMenu.h"

@interface CMMainMenu ()

@end

@implementation CMMainMenu
@synthesize article, dbManager, tableFieldItems, tableView, rootViewController;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
        [self setTableView:[[UITableView alloc] init]];
        [self setRootViewController:[[UIViewController alloc] init]];
        
    }
    return self;
}

- (void)initializeWithArticle:(HHArticleModel *)a andHHManager:(SqLiteDatabaseManager*)db
{
    [self setArticle:a];
    [self setDbManager:db];
    [self setTableFieldItems:[[NSMutableArray alloc] init]];
    
    
    
    NSDictionary* structuredData = [[self dbManager] parseArticleData:[[self article] data]];
    
    for (id fieldID in structuredData) {
        
        HHFieldModel* field = [structuredData objectForKey:fieldID];
        
        if ([field.fieldTypeName isEqualToString:@"main_menu_item"]) {
            [tableFieldItems addObject:field];
        }else if ([field.name isEqualToString:@"title"])
        {
            self.title = field.data;
        }
    }
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    [[self tableView] setDelegate:self];
    [self.tableView setDataSource:self];
    [self setNavigationBarHidden:NO];
    [self.navigationBar setBackgroundColor:[UIColor blackColor]];
    [self.tableView setFrame:CGRectMake(0, 0, self.view.frame.size.width, self.view.frame.size.height)];
    [self.tableView setBackgroundColor:[UIColor blackColor]];
    [self.navigationBar setTintColor:[UIColor blackColor]];
    [self.view setBackgroundColor:[UIColor blackColor]];
    [self.rootViewController.view setFrame:CGRectMake(0, 0, self.view.frame.size.width , self.view.frame.size.height)];
    [self.rootViewController.view addSubview:tableView];
    [self.rootViewController.view setBackgroundColor:[UIColor orangeColor]];
    [self.rootViewController setTitle:self.title];
    [self pushViewController:self.rootViewController animated:NO];
    
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    
    // Return the number of sections.
    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    
    // Return the number of rows in the section.
    return tableFieldItems.count;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    static NSString *CellIdentifier = @"Cell";
    CMMainMenuItem *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    if (cell == nil) {
        cell = [[[CMMainMenuItem alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] autorelease];
    }
    
    HHFieldModel* field = [tableFieldItems objectAtIndex:indexPath.row];
    [cell initializeWithField:field andHHManager:dbManager];
    
    return cell;
}

-(CGFloat)tableView:(UITableView *)tableView heightForRowAtIndexPath:(NSIndexPath *)indexPath
{
    return ( (self.view.frame.size.height - 40.0) / (CGFloat)tableFieldItems.count);
}


/*
 // Override to support conditional editing of the table view.
 - (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath
 {
 // Return NO if you do not want the specified item to be editable.
 return YES;
 }
 */

/*
 // Override to support editing the table view.
 - (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath
 {
 if (editingStyle == UITableViewCellEditingStyleDelete) {
 // Delete the row from the data source
 [tableView deleteRowsAtIndexPaths:@[indexPath] withRowAnimation:UITableViewRowAnimationFade];
 }
 else if (editingStyle == UITableViewCellEditingStyleInsert) {
 // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
 }
 }
 */

/*
 // Override to support rearranging the table view.
 - (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath
 {
 }
 */

/*
 // Override to support conditional rearranging of the table view.
 - (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath
 {
 // Return NO if you do not want the item to be re-orderable.
 return YES;
 }
 */

#pragma mark - Table view delegate

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Navigation logic may go here. Create and push another view controller.
    /*
     <#DetailViewController#> *detailViewController = [[<#DetailViewController#> alloc] initWithNibName:@"<#Nib name#>" bundle:nil];
     // ...
     // Pass the selected object to the new view controller.
     [self.navigationController pushViewController:detailViewController animated:YES];
     [detailViewController release];
     */
    HHFieldModel* field = [tableFieldItems objectAtIndex:indexPath.row];
    NSNumber* articleID;
    for (id key in field.children) {
        HHFieldModel* child = [field.children objectForKey:key];
        if ([child.fieldTypeName isEqualToString:@"link_to_article"])
        {
            articleID = child.data;
        }
        
    }
    
    
    
    NSMutableDictionary *action = [[NSMutableDictionary alloc] init];
    [action setObject:@"push article" forKey:@"action"];
    

    [action setObject:articleID forKey:@"article"];
    [[NSNotificationCenter defaultCenter] postNotificationName:@"HHAction" object:self userInfo:action];

    
    //UIViewController* test = [[UIViewController alloc] init];
    //[test.view setBackgroundColor:[UIColor brownColor]];
    //[self pushViewController:test animated:YES];
    NSLog(@"table delegate");
}

@end
